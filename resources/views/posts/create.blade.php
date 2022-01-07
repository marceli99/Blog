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
    <form method="POST" action="{{ route('save_post') }}" enctype="multipart/form-data">
        @csrf

        <label for="name">{{ __('Title') }}</label>
        <input id="name" name="name" type="text" value="{{old('name')}}" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="content">{{ __('Content') }}</label>
        <textarea id="content" name="content" type="text" required>{{old('content')}}</textarea>
        @error('content')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <label for="image">{{ __('Image') }}</label>
        <input id="image" name="image" type="file" onchange="readURL(this)">
        <img id="img_prev" src="#" alt=""/>

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
