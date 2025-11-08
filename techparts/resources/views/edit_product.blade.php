@extends('layouts')

@section('title', 'Edit Product | TechPartsHub')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
  <h2 class="mb-4 text-center">Edit Product</h2>

  <form action="{{route('product.update', $product->product_id)}}" method="POST" enctype="multipart/form-data">
    @crsf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Product ID</label>
      <input type="text" class="form-control" name="product_id" value="{{$product->product_id}}" readonly>
    </div>

    <div class="mb-3">
      <label class="form-label">Product Name</label>
      <input type="text" class="form-control" name="name" value="{{$product->name}}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Product Category</label>
      <select class="form-select" name="cat" required>
          <option value="">Select a Category</option>
          @foreach (['Processor', 'Motherboard', 'RAM', 'Storage', 'GPU', 'Power Supply', 'Peripherals'] as $category)
            <option value="{{ $category }}" {{ $product->cat === $category ? 'selected ':" }}> {{ $category }} </option>
            @endforeach
     </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Quantity</label>
      <input type="number" class="form-control" name="qty" value="{{$product->qty}}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Price (₱)</label>
      <input type="number" step="0.01" class="form-control" name="price" value="{{$product->price}}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Current Picture</label><br>
        @if($product->picture_id && file_exists(public_path('storage/'. $product->picture_id)))
        <img scr= "{{asset('storage/'. $product->picture_id)}}" alt="{{ $product->name }}" width="100" class="img-thumbnail mb-2">
        @else
        <img src="https://via.placeholder.com/100?text=No+Image" class="img-thumbnail mb-2" alt="No Image">
        @endif
      <input type="file" class="form-control" name="picture" accept="image/*">
    </div>

      @csrf
    <div class="d-flex justify-content-between">
      <a href="{{route('product.list')}}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-warning">Update Product</button>
    </div>
  </form>
</div>
@endsection
