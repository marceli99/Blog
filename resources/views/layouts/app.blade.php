<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<nav>
    <h1>Blog</h1>
    <ul>
        @if (Route::has('home'))
            <li>
                <a href="{{ route('home') }}">{{ __('Home') }}</a>
            </li>
        @endif
        @guest
            @if (Route::has('login'))
                <li>
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
        @else
            @if (Route::has('create_post'))
                <li>
                    <a href="{{ route('create_post') }}">{{ __('Create post') }}</a>
                </li>
            @endif
            @if (Route::has('posts'))
                <li>
                    <a href="{{ route('posts') }}">{{ __('Edit posts') }}</a>
                </li>
            @endif
                @if (Route::has('change_password'))
                    <li>
                        <a href="{{ route('change_password') }}">{{ __('Change password') }}</a>
                    </li>
                @endif
            @if (Route::has('logout'))
                <li>
                    <a href="{{ route('logout') }}">{{ __('Logout') }}</a>
                </li>
            @endif

        @endguest
    </ul>
</nav>
<article>
    @yield('content')
</article>
</body>
</html>
