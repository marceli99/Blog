@extends('layouts.app')

@section('content')
    @if (session('status'))
        <span role="alert">
            <strong class="success">{{ session('status') }}</strong>
        </span>
    @elseif(session('failed'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ session('failed') }}</strong>
        </span>
    @endif
    <form method="POST" action="{{ route('update_post') }}" enctype="multipart/form-data">
        @csrf
        <input name="id" type="hidden" value="{{$p->id}}">

        <label for="name">{{ __('Title') }}</label>
        <input id="name" name="name" type="text" value="{{empty(old('name')) ? $p->name : old('name')}}" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="content">{{ __('Content') }}</label>
        <textarea id="content" name="content" type="text">{{empty(old('content')) ? $p->content : old('content')}}</textarea>
        @error('content')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="image">{{ __('Image') }}</label>
        <input id="image" name="image" type="file" onchange="readURL(this)">
        @if($p->hasImageAttached())
            <img id="img_prev" src="data:image/jpeg;base64,{{base64_encode(\Illuminate\Support\Facades\Storage::get('public/'.$p->image))}}" alt=""/>
        @else
            <img id="img_prev" src="#" alt=""/>
        @endif

        <button type="submit">
            {{ __('Save') }}
        </button>
    </form>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('img_prev').setAttribute('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
