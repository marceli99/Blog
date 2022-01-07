@extends('layouts.app')

@section('content')
    @if (session('status'))
        <span role="alert">
            <strong class="success">{{ session('status') }}</strong>
        </span>
    @endif
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        @foreach(App\Models\Post::hydrate($posts->items()) as $post)
            <tr>
                <td>{{\Illuminate\Support\Str::limit($post->name, 20)}}</td>
                <td>{{new \Illuminate\Support\HtmlString(\Illuminate\Support\Str::limit($post->content, 21))}}</td>
                <td>@if($post->hasImageAttached()) <img src="{{\Illuminate\Support\Facades\Storage::url($post->image)}}" alt="Image"> @endif</td>
                <td>
                    <a href="{{ route('post', ['id' => $post->id]) }}">&#x2635;&ensp;View</a>
                    <br/>
                    <a href="{{ route('edit_post', ['id' => $post->id]) }}">&#9874;&ensp;Edit</a>
                    <br/>
                    <a href="{{ route('delete_post', ['id' => $post->id]) }}" onclick="return confirm('Are you sure?')">&#10006;&ensp;Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $posts->links('vendor/pagination/default') }}
@endsection
