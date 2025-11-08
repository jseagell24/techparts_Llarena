<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productcontroller;

route::get('/viewproduct', [productcontroller::class, 'index'])->name('product.view');
route::get('/productview', [productcontroller::class, 'product_manage'])->name('product.list');
route::get('/product/add',[productcontroller::class, 'product_create'])->name('product.create');
route::post('/product/add', [productcontroller::class, 'product_save'])->name('product.save');
route::get('/product/{product_id}/edit', [productcontroller::class, 'product_edit']) ->name('product.edit');
route::put('/product/update/{product_id}', [productcontroller::class, 'product_update'])->name('product.update');
route::delete('/product/{product_id}/delete', [productcontroller::class, 'product_delete'])->name('product.delete');
route::get('/products/pdf', [productcontroller::class, 'downloadPDF'])->name('products.pdf');
