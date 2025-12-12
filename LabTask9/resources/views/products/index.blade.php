<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="container">
    <h1>Products Management</h1>

    <form action="{{ route('products.index') }}" method="GET" style="display:flex; gap:10px;">
        <input type="text" name="search" placeholder="Search by name..." value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>
    
    <br>
    <a href="{{ route('products.create') }}" class="btn-link">+ Create New Product</a>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($products->count() > 0)
                @foreach($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" width="80" height="80" style="object-fit:cover;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                        
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align:center;">No products found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

</body>
</html>