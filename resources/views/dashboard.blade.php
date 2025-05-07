<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
        }

        h2, h3 {
            color: #34495e;
        }

        .alerts {
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            padding: 10px;
            border-left: 5px solid #28a745;
            color: #155724;
            margin-bottom: 10px;
        }

        .alert-error {
            background-color: #f8d7da;
            padding: 10px;
            border-left: 5px solid #dc3545;
            color: #721c24;
            margin-bottom: 10px;
        }

        .summary-cards {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 180px;
            background: white;
            padding: 15px;
            border-left: 5px solid #3498db;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }

        .card.low-stock {
            border-left-color: #e67e22;
        }

        .card h4 {
            margin: 0;
            font-size: 16px;
            color: #666;
        }

        .card p {
            font-size: 22px;
            margin: 5px 0 0;
            color: #2c3e50;
        }

        form {
            margin-bottom: 20px;
        }

        input, select, button {
            padding: 8px;
            margin: 5px 5px 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #3498db;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #ecf0f1;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        hr {
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                text-align: center;
            }

            .content {
                padding: 15px;
            }

            .summary-cards {
                flex-direction: column;
            }
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            color: white;
            cursor: pointer;
        }

        .btn-stockin {
            background-color: #27ae60;
        }

        .btn-stockin:hover {
            background-color: #219150;
        }

        .btn-stockout {
            background-color: #2980b9;
        }

        .btn-stockout:hover {
            background-color: #2471a3;
        }

        .btn-delete {
            background-color: #e74c3c;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-update {
            background-color: #f39c12;
        }

        .btn-update:hover {
            background-color: #d68910;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            flex-direction: row; /* Ensures buttons are aligned horizontally */
            justify-content: flex-start;
        }

        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            text-align: center;
            padding: 15px;
            position: relative;
            bottom: 0;
            width: 100%;
            font-size: 14px;
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h2><i class="fas fa-store"></i> BERWA SHOP</h2>
        <ul>
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-plus"></i> Add Product</a></li>
            <li><a href="#"><i class="fas fa-boxes"></i> Stock List</a></li>
        </ul>
    </div>

    <div class="content">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>

        {{-- Alert Messages --}}
        <div class="alerts">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif
        </div>

        <div class="summary-cards">
            <div class="card">
                <h4><i class="fas fa-box"></i> Total Products</h4>
                <p>{{ count($stocks) }}</p>
            </div>
            <div class="card">
                <h4><i class="fas fa-cubes"></i> Total Stock Quantity</h4>
                <p>{{ $totalQuantity }}</p>
            </div>
            <div class="card low-stock">
                <h4><i class="fas fa-exclamation-triangle"></i> Low Stock (≤5)</h4>
                <p>{{ $lowStockCount }}</p>
            </div>
        </div>
        

        <h3><i class="fas fa-plus"></i> Add New Product</h3>
        <form method="POST" action="{{ route('stock.add') }}">
            @csrf
            <input type="text" name="product_name" placeholder="Product Name" required>
            <input type="number" name="quantity" placeholder="Initial Quantity" required>
            <button type="submit"><i class="fas fa-plus"></i> Add Product</button>
        </form>

        <hr>

        <h3><i class="fas fa-boxes"></i> Stock List</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
            @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->product_name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>
                    <div class="btn-group">
                        <!-- Stock In -->
                        <form action="{{ route('stockin') }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
                            @csrf
                            <select name="stock_id" required>
                                @foreach ($stocks as $item)
                                    <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="quantity" placeholder="Qty" required>
                            <button type="submit" class="btn btn-stockin"><i class="fas fa-arrow-up"></i> Stock In</button>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('stock.delete', $stock->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"  style="margin-top:8px ;"><i class="fas fa-trash"></i> Delete</button>
                        </form>

                        <!-- Update Button -->
                        <form action="{{ route('stock.update', $stock->id) }}" method="GET">
                            <button type="submit" class="btn btn-update" style="margin-top:8px ;"><i class="fas fa-edit" ></i> Update</button>
                        </form>
                    </div>
                
                    <!-- Stock Out -->
                    <form action="{{ route('stockout') }}" method="POST" style="display: flex; gap: 10px; align-items: center;">
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                        <input type="number" name="quantity" min="1" placeholder="Qty" required>
                        <button type="submit" class="btn btn-stockout"><i class="fas fa-arrow-down"></i> Stock Out</button>
                    </form>
                
                </td>
                
            </tr>
            @endforeach
        </table>
        

    </div>
</div>
<hr>
<h3><i class="fas fa-history"></i> Stock Movement Report</h3>
<table>
    <tr>
        <th>Product</th>
        <th>Type</th>
        <th>Quantity</th>
        <th>Date</th>
    </tr>
    @foreach($histories as $history)
        <tr>
        <td>{{ $history->stock->product_name ?? 'Deleted Product' }}</td>
            <td>{{ ucfirst($history->type) }}</td>
            <td>{{ $history->quantity }}</td>
            <td>{{ $history->created_at->format('Y-m-d H:i') }}</td>
        </tr>
    @endforeach
</table>

<footer class="footer">
    <p>&copy; {{ date('Y') }} BERWA SHOP. All rights reserved.</p>
</footer>

</body>
</html>
