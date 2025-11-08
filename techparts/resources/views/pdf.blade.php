
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Product List - TechPartsHub</title>
        <style>
            body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
            }
            h2 {
            text-align: center;
            margin-bottom: 10px;
            }
            table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            }
            th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            }
            th {
            background-color: #222;
            color: #fff;
            }
            img {
            width: 60px;
            height: auto;
            }
            .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            }
            .header p {
            font-size: 11px;
            }
        </style>
        </head>
    <body>
        <div class="header">
            <h2>TechPartsHub - Product List</h2>
            <p>Generated on: {{ now()->format('F d, Y h:i A') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Picture</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->cat }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>
                @if($product->picture_id && file_exists(public_path('storage/' . $product->picture_id)))
                    <img src="{{ public_path('storage/' . $product->picture_id) }}" alt="Image">
                @else
                    N/A
                @endif
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
