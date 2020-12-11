@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit {{ $product->name }}</div>
            <div class="card-body">
                <form autocomplete="off" action="/product/{{$product->id}}" method="post" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $product->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Product Type</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                            @foreach($productTypes as $productType)
                                <option value="{{ $productType->id }}" {{ old('type', $product->product_type_id) == $productType->id ? 'selected' : '' }}>{{ $productType->name }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') ?? $product->stock }}">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') ?? $product->price }}">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea name="desc" id="desc" rows="3" class="form-control @error('desc') is-invalid @enderror">{{ old('desc') ?? $product->desc }}</textarea>
                        @error('desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <input class="btn btn-primary card-link" type="submit" value="Submit">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary card-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection