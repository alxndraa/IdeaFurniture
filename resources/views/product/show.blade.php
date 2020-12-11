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
                <h5>Rp {{ number_format($product->price, 0, ",", ".") }}</h5>
                <p>Stock : {{ $product->stock }}</p>

                @auth
                    @if(Auth::user()->role == 'member')
                        <form action="/{{Auth::user()->id}}/{{$product->id}}/{amount}/attach">
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" value="{{ old('qty') }}">
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="submit" class="btn btn-primary card-link" {{ $product->stock < 1 ? 'disabled' : '' }} value="{{ $product->stock < 1 ? 'Out of Stock' : 'Add to Cart' }}">
                        </form>
                    @endif
                @endauth
            </div>

            </div>
        </div>
    </div>
@endsection