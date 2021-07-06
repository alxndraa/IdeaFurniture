@extends('layouts.app')

@section('content')
<div class="one-page-container gradient-background">
    <div class="card mx-auto shadow" style="width: 30em;">
        <div class="title text-gray mt-5">{{ __('Login') }}</div>

        <div class="card-body" style="width: 80%;">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-check d-inline-block">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="btn-link d-inline-block float-right" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-primary my-3" style="width: 100%;">
                    {{ __('Login') }}
                </button>
            </form>
        </div>

        <div class="card-footer text-center">
            Don't have an account? <a href="{{ route('register') }}">{{ __('Register') }}</a>
        </div>
    </div>
</div>
@endsection