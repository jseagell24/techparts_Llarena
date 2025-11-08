<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'TechPartsHub')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold"  href="{{route('product.view')}}">TechPartsHub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="{{route('product.view')}}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('product.list')}}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Transaction</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Account</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Page Content -->
<main class="flex-grow-1">
  @yield('content')
</main>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
  <p class="mb-0">© <span id="year"></span> TechPartsHub. All rights reserved.</p>
</footer>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('year').textContent = new Date().getFullYear();
</script>

</body>
</html>
