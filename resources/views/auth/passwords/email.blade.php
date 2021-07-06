@extends('layouts.app')

@section('content')
<div class="one-page-container gradient-background">
    <div class="card mx-auto shadow" style="width: 30em;">
        <div class="title text-gray mt-5">{{ __('Reset Password') }}</div>

        <div class="card-body" style="width: 80%;">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mb-3" style="width: 100%;">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
