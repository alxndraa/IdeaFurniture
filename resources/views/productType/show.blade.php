@extends('layouts.app')

@section('style')
<style>
    .banner {
        height: 35vh;
    }
    .banner::after{
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        display: inline-block;
        background: linear-gradient(90deg, rgba(255,255,255,0), rgba(0, 0, 0, 0.2) , rgba(255,255,255,0));
    }
</style>
@endsection

@section('content')
    <div class="banner">
        <img class="banner-img" src="{{ asset('storage/'.$productType->image) }}" alt="">
        <h1 class="banner-title ">{{ $productType->name }}</h1>
    </div>

    <div class="container py-5">
        <div class="d-flex justify-content-between">
            <span class="bold"> Total products: {{ $products->total() }} </span>
            {{ $products->links() }}
        </div>

        <div class="grid-container">
            @foreach($products as $product)
                <div class="grid-item" onclick="location.href='/product/{{$product->id}}'">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="" class="grid-item-img">

                    <div class="grid-item-body my-4">
                        <div class="card-title text-orange">{{ $product->name }}</div>
                        <div class="card-subtitle">{{ $product->desc }}</div>
                        <div class="font-weight-bold">Rp {{ number_format($product->price, 0, ",", ".") }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <span class="d-flex justify-content-end">{{ $products->links() }}</span>
    </div>
    
    <!--
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
    -->
@endsection