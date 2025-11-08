<?php

namespace App\Http\Controllers;
use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class productcontroller extends Controller
{
    public function index(Request $request){
        $search = $request -> input('search');

        $products = Product::query()
        ->when($search, function ($query, $search){
            $query->where('name', 'like', "%{$search}%")
            ->orWhere('cat', 'like', "%{$search}%");
        })

        ->orderBy('created_at', 'desc')
        ->get();

        return view('home', compact('products', 'search'));
    }

    public function product_manage(Request $request){
        $search = $request->input('search');
        $products = Product::query()
        ->when ($search, function ($query, $search){
            return $query ->where('name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view ('products', compact('products', 'search'));
    }

    public function product_create(){
        $newProductId =$this->generateproductid();
        return view('add_product', compact('newProductId'));
    }

    public function product_save(Request $request){
        $request->validate([
            'product_id'=>'required|string|max:15',
            'name'=>'required|string|max:255',
            'cat'=>'required|string|max:255',
            'qty'=>'required|integer|min:0',
            'price'=>'required|numeric|min:0',
            'picture_id'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fileName = null;
        if($request->hasFile('picture_id')){
            $file=$request->file('picture_id');
            $fileName = time(). '' . Str::random(10).''.$file->getClientOriginalExtension();
            $filePath = 'product_image/'.$fileName;
            $file->storeAs('product_image',$fileName,'public');
        }

        Product::create([
            'product_id'=>$request->product_id,
            'name'=>$request->name,
            'cat'=>$request->cat,
            'qty'=>$request->qty,
            'price'=>$request->price,
            'picture_id'=>$filePath,
        ]);
        return redirect()->route('product.create')->with('success','Product added successfully.');
    }

    private function generateproductid() {
        $latestProduct = Product::orderBy('created_at','desc')->first();
            if(!$latestProduct){
                return 'PROD001';
            }

            $latestNumber = intval(substr($latestProduct->product_id,4));
            $nextIdNumber = $latestNumber + 1;
            return 'PROD' . str_pad($nextIdNumber,3,'0',STR_PAD_LEFT);
        }

    public function product_edit($product_id){
        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('edit_product', compact('product'));
        }

    public function product_update(Request $request, $product_id){
        $product = Product::where('product_id', $product_id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'cat' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            if($product->picture_id && Storage::disk ('public')-> exists('product_image/' . $product->picture_id)){
                Storage::disk('public')->delete('product_image/' . $product->picture_id);
            }

            $file = $request->file('picture');
            $fileName = time(). '_' . Str::random(10).'.'. $file->getClientOriginalExtension();
            $file->storeAs('product_image', $fileName, 'public');
            $product->picture_id = 'product_image/' . $fileName;

        }

        $product->update([
           'name' => $request->name,
            'cat' => $request->cat,
            'qty' => $request->qty,
            'price' => $request->price,
            'picture_id' => $product->picture_id,
        ]);

        return redirect()->route('product.list')->with('success', 'Product updated successfully!');

    }

    public function product_delete($product_id){
        $product = Product::where('product_id', $product_id)->firstOrFail();

        if($product->picture_id && Storage::disk('public')->exists('product_image/' . $product->picture_id)){
            Storage::disk('public')->delete('product_image/' . $product->picture_id);
        }

        $product->delete();

        return redirect()->route('product.list')->with('success', 'Product deleted successfully!');

    }

    public function downloadPDF(){
        $products = Product::all();

        $pdf = Pdf::loadView('pdf', compact('products'))
        ->setPaper ('letter', 'portrait' );
        return $pdf->download('Products_List.pdf');
    }


}





