@extends('layouts.app')

@section('content')
    @foreach(App\Models\Post::hydrate($posts->items()) as $p)
        @include('partials.post', ['fullContent' => false])
    @endforeach

    {{ $posts->links('vendor/pagination/default') }}
@endsection
