@extends('layouts')
@section('title', 'Home | TechPartsHub')
@section('content')
<!-- Hero Section -->
    <section class="bg-light py-5 text-center">
    <div class="container">
    <h1 class="display-4 fw-bold">Welcome to TechPartsHub</h1>
    <p class="lead">Your trusted source for high-quality computer components and
    accessories.</p>

    <form action="{{ route('product.view') }}" method="GET" class="d-flex justify-content-
    center mt-4" style="max-width: 500px; margin: auto;">

    <input
    class="form-control me-2"
    type="search"
    name="search"
    placeholder="Search products..."
    value="{{ request('search') }}"
    >
    <button class="btn btn-primary" type="submit">Search</button>
    </form>
    </div>
    </section>
    <!-- Featured Products -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">
    @if(!empty($query))
    Search Results for: "{{ $query }}"
    @else
    Available Products
    @endif
    </h2>
        <div class="row g-4">
    @forelse($products as $product)
        <div class="col-md-4">
    <div class="card h-100">
    <img
        src="{{ asset('storage/' . $product->picture_id) }}"
             alt="{{ $product->name }}"
                class="card-img-top img-fluid"
                 style="width: 100%; height: 150px; object-fit: contain; border-radius: 8px;
            background-color: #f8f9fa;"
        onerror="this.src='https://via.placeholder.com/150x150?text=No+Image';"/>

    <div class="card-body text-center">
        <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">Category: {{ $product->cat }}</p>
        <p class="fw-bold">₱{{ number_format($product->price, 2) }}</p>
     </div>
    </div>
    </div>
    @empty
        <p class="text-center text-muted">No products found.</p>
    @endforelse
    </div>
        </div>
    </section>
    @endsection
