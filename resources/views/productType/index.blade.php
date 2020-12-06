@extends('layouts/app')

@section('content')
    <a href="/productType/create" class="btn btn-secondary card-link">
        <!--icon pke font awesome!-->
        <i class="fas fa-plus-circle"></i>Product Type
    </a>
    <a href="/product/create" class="btn btn-secondary card-link">Product</a>

    <div class="container">
        <div class="row row-cols-3">
            @foreach($productTypes as $productType)
                <div class="col mb-4">
                    <div class="card">
                        <img src="" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/productType/{{$productType->id}}">{{ $productType->name }}</a>
                            </h5>
                            <a href="/productType/{{$productType->id}}/edit" class="btn btn-primary">Update</a>
                            <form action="/productType/{{$productType->id}}" method="post" style="display:inline">
                                @csrf
                                @method("DELETE")
                                <input class="btn btn-outline-danger" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
@endsection