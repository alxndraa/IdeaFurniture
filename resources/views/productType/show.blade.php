@extends('layouts.app')

@section('content')
    <form method="get" action="/search/{{$productType->id}}" class="form-inline float-right">
        @csrf
        <input type="text" name="search" id="search" class="form-control" placeholder="Search product">
        <input type="submit" class="btn btn-primary" value="Search">
    </form>

    <h1 class="text-center">{{ $productType->name }}</h1>

    <div class="container">
        <hr>
        <div class="row row-cols-3">
            @foreach($products as $product)
                <div class="col mb-4">
                    <div class="card">
                        <img src="" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/product/{{$product->id}}">{{ $product->name }}</a>
                            </h5>
                            <p class="card-text">Rp {{ number_format($product->price, 0, ",", ".") }}</p>
                            <p class="card-text">{{ $product->desc }}</p>

                            @auth
                                @if(Auth::user()->role == 'admin')
                                    <a href="/product/{{$product->id}}/edit" class="btn btn-primary">Update</a>
                                    <form action="/product/{{$product->id}}" method="post" style="display:inline">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn btn-outline-danger" value="Delete">
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    </div>
@endsection