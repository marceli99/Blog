@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('update_password') }}">
        @csrf

        @if (session('success'))
            <span role="alert">
                <strong class="success">{{ session('success') }}</strong>
            </span>
        @endif
        @foreach ($errors->all() as $error)
            <p class="invalid-feedback">{{ $error }}</p>
        @endforeach

        <label for="password">{{ __('Old password') }}</label>
        <input id="password" type="password" name="password"
               value="{{ old('password') }}" required autocomplete="password" autofocus>

        <label for="new_password">{{ __('New password') }}</label>
        <input id="new_password" type="password"
               name="new_password" required>

        <label for="confirm_new_password">{{ __('New password') }}</label>
        <input id="confirm_new_password" type="password"
               name="confirm_new_password" required>

        <label for="new_email">{{ __('New email') }}</label>
        <input id="new_email" type="email"
               name="new_email">

        <button type="submit">
            {{ __('Submit') }}
        </button>

    </form>

@endsection
