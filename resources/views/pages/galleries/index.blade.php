@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Product Gallery</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('galleries.create') }}" class="btn btn-primary mb-3">Create New Product</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Photo</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galleries as $gallery)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $gallery->product->name }}</td>
                                <td><img src="{{ asset('storage/' . $gallery->photo) }}" alt="Gallery Photo" class="img-fluid"></td>
                                <td>{{ $gallery->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
