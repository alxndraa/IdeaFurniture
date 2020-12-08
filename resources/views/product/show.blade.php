@extends('layouts/app')

@section('style')
    <style>
        .image-container{
            background: gray;
            height: 40em;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col image-container">
                <img src="" alt="">
            </div>

            <div class="col">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->desc }}</p>
                <h5>Rp {{ $product->price }}</h5>
                <p>Stock : {{ $product->stock }}</p>

                <form action="">
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}">
                        @error('qty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input class="btn btn-primary card-link" type="submit" value="Add to Cart">
                </form>
            </div>

            </div>
        </div>
    </div>
@endsection