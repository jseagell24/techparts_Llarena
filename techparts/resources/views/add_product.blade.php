@extends('layouts')

@section('title', 'Add Product | TechPartsHub')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
  <h2 class="mb-4 text-center">Add New Product</h2>


  {{-- Success Message --}}
  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Validation Errors --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Product Form --}}
  <form action="{{ route('product.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- Product ID --}}
    <div class="mb-3">
      <label class="form-label fw-bold">Product ID</label>
      <input
        type="text"
        class="form-control bg-light"
        name="product_id"
        value="{{ $newProductId }}"
        readonly
      >
    </div>

    {{-- Product Name --}}
    <div class="mb-3">
      <label class="form-label fw-bold">Product Name</label>
      <input
        type="text"
        class="form-control"
        name="name"
        value="{{ old('name') }}"
        placeholder="Enter product name"
        required
      >
    </div>

    {{-- Product Category --}}
    <div class="mb-3">
      <label class="form-label fw-bold">Product Category</label>
      <select class="form-select" name="cat" required>
          <option value="">Select a Category</option>
            @foreach (['Processor','Motherboard','RAM','Storage','GPU','Power
                      Supply','Peripherals'] as $category)

                      <option value="{{ $category }}" {{ old('cat') == $category ? 'selected' : '' }}>
                        {{ $category }}
                      </option>
            @endforeach
          <option value="Processor" >Processor</option>
          <option value="Motherboard" >Motherboard</option>
          <option value="RAM" >RAM</option>
          <option value="Storage" >Storage</option>
          <option value="GPU" >GPU</option>
          <option value="Power Supply" >Power Supply</option>
          <option value="Peripherals" >Peripherals</option>
      </select>
    </div>

    {{-- Quantity --}}
    <div class="mb-3">
      <label class="form-label fw-bold">Quantity</label>
      <input
        type="number"
        class="form-control"
        name="qty"
        min="0"
        value="{{ old('qty') }}"
        placeholder="Enter quantity"
        required
      >
    </div>

    {{-- Price --}}
    <div class="mb-3">
      <label class="form-label fw-bold">Price (₱)</label>
      <input
        type="number"
        step="0.01"
        class="form-control"
        name="price"
        value="{{ old('price') }}"
        placeholder="Enter price"
        required
      >
    </div>

    {{-- Product Picture --}}
    <div class="mb-3">
      <label class="form-label fw-bold">Product Picture</label>
      <input
        type="file"
        class="form-control"
        name="picture_id"
        accept="image/*"
        required
      >
      <small class="text-muted">Accepted formats: JPG, PNG (max: 2MB)</small>
    </div>

    {{-- Buttons --}}
    <div class="d-flex justify-content-between">
      <a href="{{ route('product.list') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Cancel
      </a>
      <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> Save Product
      </button>
    </div>
  </form>
</div>
@endsection
