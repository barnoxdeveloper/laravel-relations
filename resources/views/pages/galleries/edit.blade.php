@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Photo in Product Gallery</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                @foreach($products as $item)
                                <option value="{{ $item->id }}" {{ $gallery->product_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <img id="photoPreview" src="{{ asset('storage/' . $gallery->photo) }}" alt="Current Photo" class="img-fluid mt-2" style="max-height: 200px;">
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ $gallery->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$gallery->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
