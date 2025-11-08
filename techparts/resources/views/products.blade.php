@extends('layouts')

@section('title', 'Products | TechPartsHub')

@section('content')
<div class="container mt-4">

  <div class="d-flex justify-content-between mb-3">
    <h3>Product List</h3>
  </div>
    @if(!empty($search))
      <p class="text-muted">Showing results for: <strong>{{ $search }}</strong></p>
    @endif
  <!-- Search and Add Product -->
  <div class="d-flex justify-content-between align-items-center mb-3">

  <!-- Search Form (Left Side) -->
        <form method="GET" action="{{ route('product.list') }}" class="d-flex align-items-center" style="gap: 8px;">
            <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search products by name..."
            value="{{ $search??'' }}"
            style="width: 250px;">
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>

        <!-- Add Product Button (Right Side) -->
        <div class="d-flex gap-2">
            <a href="{{ route('products.pdf') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i>Download PDF
            </a>
        <a href="{{ route('product.create') }}" class="btn btn-primary">
            + Add Product
        </a>
        </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Picture</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
      @forelse ($products as $product)
        <tr>
          <td>{{ $product->product_id }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $product->cat }}</td>
          <td>{{ $product->qty }}</td>
          <td>₱{{ number_format($product->price,2) }}</td>
          <td>
          @if ($product->picture_id && file_exists(public_path('storage/' . $product->picture_id)))
            <img src="{{ asset('storage/' . $product->picture_id) }}"
                 alt="{{ $product->name }}"
                 width="60"
                 class="img-thumbnail">
          @else
            <img src="https://via.placeholder.com/60?text=No+Image"
                 alt="No Image"
                 class="img-thumbnail">
          @endif
          </td>
          <td>
             <a href="{{ route('product.edit', $product->product_id) }}" class="btn btn-sm btn-warning">Edit</a>

            <form
              action="{{ route('product.delete', $product->product_id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this product?');"
              style="display:inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted">No products found.</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </div>

</div>
@endsection
