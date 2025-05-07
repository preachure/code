
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            padding: 40px;
        }

        .form-container {
            background-color: #fff;
            max-width: 500px;
            margin: auto;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-left: 5px solid #3498db;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #2980b9;
        }

        a.back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #3498db;
        }

        a.back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fas fa-edit"></i> Edit Product</h2>
    <form method="POST" action="{{ route('stock.save', $stock->id) }}">
        @csrf
        @method('PUT')

        <input type="text" name="product_name" value="{{ $stock->product_name }}" placeholder="Product Name" required>
        <input type="number" name="quantity" value="{{ $stock->quantity }}" placeholder="Quantity" required>

        <button type="submit"><i class="fas fa-save"></i> Save Changes</button>
    </form>

    <a href="{{ route('dashboard') }}" class="back"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>

</body>
</html>
edit.balde.php
Displaying edit.balde.php.