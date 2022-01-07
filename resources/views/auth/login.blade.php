@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">{{ __('E-Mail Address') }}</label>

        <input id="email" type="email" class="@error('email') @enderror" name="email"
               value="{{ old('email') }}" required autocomplete="email" autofocus>

        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

        <input id="password" type="password" class="@error('password') @enderror"
               name="password" required autocomplete="current-password">

        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <button type="submit">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif

    </form>

@endsection
