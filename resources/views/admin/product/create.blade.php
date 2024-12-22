@extends('layouts.admin')

@section('content')
    <h2>Add new product</h2>
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name product</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" id="price" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-select" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>                    
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Type</label>
            <select name="category_id" class="form-select" id="category_id" required>
                @foreach($categories as $category)                    
                    <option value="{{ $category->id }}">{{ $category->type }}</option>                    
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Manufacturer</label>
            <select name="category_id" class="form-select" id="category_id" required>
                @foreach($categories as $category)                    
                    <option value="{{ $category->id }}">{{ $category->manufacturer }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection
