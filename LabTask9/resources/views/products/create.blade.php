<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h1>Add New Product</h1>
    
    <a href="{{ route('products.index') }}" class="btn-link">← Back to List</a>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Description:</label>
        <textarea name="description" rows="4"></textarea>

        <label>Product Image:</label>
        <input type="file" name="image" required>
        
        <button type="submit" style="margin-top: 20px;">Save Product</button>
    </form>
</div>

</body>
</html>