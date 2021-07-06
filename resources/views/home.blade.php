@extends('layouts/app')

@section('style')
<style>
    .line{
        width: 4em;
        border-bottom: 0.3em solid #F28000;
        margin-top: 3em;
        margin: auto;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-auto-rows: 360px;
        gap: 1rem;
    }

    .category-img {
        height: 360px;
        width: 100%;
        object-fit: cover;
        transition: transform 1s;
    }

    .image-label{
        background-color: #F28000;
        color: white;
        padding: 0.3em 1.5em;
        position: absolute;
        bottom: 0;
    }

    .grid-item:hover .image-label{
        background: black;
    }

    .grid-item:hover .category-img{
        transform: scale(1.2);
    }

</style>

@section('content')
    <div class="banner">
        <img class="banner-img" src="{{ asset('storage/assets/home1.jpg') }}" alt="Banner">
    </div>

    <div class="container py-4">
        <div class="heading py-4">
            <h1 class="title text-gray">SHOP BY ROOM</h1>
            <div class="line"></div>
        </div>

        <div class="category-grid pb-5">
            @foreach($productTypes as $productType)
                <div class="grid-item" onclick="location.href='/productType/{{$productType->id}}'">
                    <img src="{{ asset('storage/'.$productType->image) }}" class="category-img">
                    <div class="image-label">{{ $productType->name }}</div>
                </div>
            @endforeach
        </div>

        <!--
        @auth
            @if(Auth::user()->role == 'admin')
                <a href="/productType/{{$productType->id}}/edit" class="btn btn-primary">Update</a>
                <form action="/productType/{{$productType->id}}" method="post" style="display:inline">
                    @csrf
                    @method("DELETE")
                    <input class="btn btn-outline-danger" type="submit" value="Delete">
                </form>
            @endif
        @endauth
        -->
    </div>
    
@endsection