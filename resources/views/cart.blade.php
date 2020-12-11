@extends('layouts/app')

@section('content')
    <h1 class="text-center">Shopping Cart</h1>

    <div class="container">
        @if(count($cartItems) == 0)
            <h2 class="text-center">Cart is empty</h2>
        @else
            <!-- Initialize grand total !-->
            @php($grandTotal = 0)

            @foreach($cartItems as $cartItem)
                <div class="row">
                    <div class="col">
                        <img src="{{ asset('storage/'.$cartItem->image) }}" style="width:250px; height:250px;">
                    </div>

                    <div class="col">
                        <p>Product Name:</p>
                        <h5>{{ $cartItem->name }}</h5>
                    </div>

                    <div class="col">
                        <form action="/cart/{{$cartItem->id}}/update" method="post">
                            @csrf
                            @method("PUT")
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="submit" class="btn btn-primary" value="&#10003;">
                        </form>
                    </div>

                    <div class="col">
                        <p>Price:</p>
                        <h5>Rp {{ number_format($cartItem->price, 0, ",", ".") }}</h5>
                    </div>

                    <div class="col">
                        <p>SubTotal:</p>
                        <h1>Rp {{ number_format($cartItem->price * $cartItem->users->pivot->quantity, 0, ",", ".") }}</h1>
                    </div>

                    <form action="/cart/{{$cartItem->id}}/update" method="post" style="display:inline">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-outline-danger" value="&#10005;">
                    </form>
                </div>
            @endforeach
        @endif
    </div>
@endsection