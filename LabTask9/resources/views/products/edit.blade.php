<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h1>Edit Product</h1>

    <a href="{{ route('products.index') }}" class="btn-link">← Back to List</a>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <label>Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label>Description:</label>
        <textarea name="description" rows="4">{{ $product->description }}</textarea>

        <p>Current Image:</p>
        <img src="{{ asset('storage/' . $product->image) }}" width="100">
        <br><br>

        <label>Change Image (Optional):</label>
        <input type="file" name="image">
        
        <button type="submit" style="margin-top: 20px;">Update Product</button>
    </form>
</div>

</body>
</html>