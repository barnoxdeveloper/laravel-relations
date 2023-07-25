@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Sub Categories</h3>
                </div>
                <div class="card-body">
                    <a href="{{ route('sub-categories.create') }}" class="btn btn-primary mb-3">Create New Sub Category</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subCategories as $subCategory)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $subCategory->category->name }}</td>
                                <td>{{ $subCategory->name }}</td>
                                <td>{{ $subCategory->status ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('sub-categories.edit', $subCategory->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('sub-categories.destroy', $subCategory->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub category?')">Delete</button>
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
