@extends('layouts/app')

@section('head')
    <script type="text/javascript ">
        $(document).ready(function() {
            $('.minus').click(function() {
                var $input = $(this).parent().find('input');
                var qty = parseInt($input.val()) - 1;
                $input.val(qty);
                check(qty);
            });

            $('.plus').click(function() {
                var $input = $(this).parent().find('input');
                var qty = parseInt($input.val()) + 1;
                $input.val(qty);
                check(qty);
            });

            function check(param){
                if(param <= 1){
                    $('.minus').attr('disabled', true);
                }
                else{
                    $('.minus').attr('disabled', false);
                }
            }
        });
    </script>
@endsection

@section('style')
    <style>
        .product-img{
            overflow: hidden;
            position: relative;
        }
        .product-img img{
            width: 100%;
            object-fit: contain;
        }
        .plus, .minus{
            width: 2em;
            height: 2em;
            background-color: white;
            border:1px solid #ffb982;
            border-radius: 4px;
        }
        .plus:disabled, .minus:disabled{
            background-color: #f7f7f7;
            border: 1px solid #ddd;
        }
        .number-spinner input{
            width: 4em;
            height: 2em;
            text-align: center;
            border:1px solid #ddd;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="container one-page-container">
        <div class="row">
            <div class="col-7 product-img shadow-sm">
                <img src="{{ asset('storage/'.$product->image) }}">
            </div>

            <div class="col-5 pl-5">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->desc }}</p>
                <h3>Rp {{ number_format($product->price, 0, ",", ".") }}</h3>

                <hr>
                <p>Available stock: {{ $product->stock }}</p>
                <hr>

                <form action="">
                    <div class="itemCounter d-flex justify-content-between">
                        Quantity
                        <div class="number-spinner">
                            <button class="minus" type="button" disabled>-</button>
                            <input type="text" value="1">
                            <button class="plus" type="button">+</button>
                        </div>
                    </div>
                    
                    <input type="submit" class="btn btn-primary w-100 mt-3" value="{{ $product->stock < 1 ? 'Out of Stock' : 'Add to Cart' }}">
                </form>
            </div>

            <!--
            @auth
                @if(Auth::user()->role == 'member')
                    <form action="/{{Auth::user()->id}}/{{$product->id}}/attach">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="submit" class="btn btn-primary card-link" {{ $product->stock < 1 ? 'disabled' : '' }} value="{{ $product->stock < 1 ? 'Out of Stock' : 'Add to Cart' }}">
                    </form>
                @endif
            @endauth
            -->
        </div>
    </div>
@endsection