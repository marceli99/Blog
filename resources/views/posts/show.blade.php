@extends('layouts.app')

@section('content')
    @include('partials.post', ['fullContent' => true])
    @include('partials.comments', ['comments' => $p->comments])
@endsection
