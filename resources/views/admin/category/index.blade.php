@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Categories list</h1>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Add new</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Type</th>
                <th>Manufacturer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->type }}</td>
                    <td>{{ $category->manufacturer }}</td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure want to delete');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nothing here</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
