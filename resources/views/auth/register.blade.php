@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto" style="width: 25rem;">
        <div class="card-header">{{ __('Register') }}</div>
        <div class="card-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="name" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="gender" class="form-check-inline">Gender</label>
                    <div class="form-check-inline">
                        <input type="radio" name="gender" id="female" class="form-check-input @error('gender') is-invalid @enderror" value="female" {{old('gender') == 'female' ? 'checked' : ''}}>
                        <label class="form-check-label" for="female">Female</label>
                    </div>

                    <div class="form-check-inline">
                        <input type="radio" name="gender" id="male" class="form-check-input @error('gender') is-invalid @enderror" value="male" {{old('gender') == 'male' ? 'checked' : ''}}>
                        <label class="form-check-label" for="male">Male</label>
                    </div>

                    @error('gender')
                        <div class="invalid-feedback" style="display:block !important;">{{ $message }}</div>
                    @enderror
                </div>
                
                <input type="submit" class="btn btn-primary" value="{{ __('Register') }}">
            </form>
        </div>
    </div>
</div>
@endsection
