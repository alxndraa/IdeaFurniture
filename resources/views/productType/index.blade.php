@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row row-cols-3">
            @foreach($productTypes as $productType)
                <div class="col mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/'.$productType->image) }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/productType/{{$productType->id}}">{{ $productType->name }}</a>
                            </h5>
                            
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
@endsection