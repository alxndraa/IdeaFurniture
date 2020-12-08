@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-3">
            @foreach($productType->products as $product)
                <div class="col mb-4">
                    <div class="card">
                        <img src="" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/product/{{$product->id}}">{{ $product->name }}</a>
                            </h5>
                            <p class="card-text">Rp. {{ $product->price }}</p>
                            <p class="card-text">{{ $product->desc }}</p>

                            <a href="/product/{{$product->id}}/edit" class="btn btn-primary">Update</a>
                            <form action="/product/{{$product->id}}" method="post" style="display:inline">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-outline-danger" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $productType->products->links() }}
    </div>
@endsection