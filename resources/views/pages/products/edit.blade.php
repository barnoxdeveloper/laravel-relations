@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Featured Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="sub_category_id">Sub Category</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                @foreach($subCategories as $item)
                                <option value="{{ $item->id }}" {{ $product->sub_category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status?</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Featured Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
