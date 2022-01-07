<div class="create-comment">
    <h3>Add comment</h3>
    @if (session('status'))
        <span role="alert">
            <strong class="success">{{ session('status') }}</strong>
        </span>
    @elseif(session('failed'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ session('failed') }}</strong>
        </span>
    @endif
    <form method="POST" action="{{ route('create_comment', ['id' => $p->id]) }}" enctype="multipart/form-data">
        @csrf
        <input name="id" type="hidden" value="{{$p->id}}">

        <label for="author">{{ __('Nickname') }}</label>
        <input id="author" name="author" type="text" value="{{old('author')}}" required>
        @error('author')
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

        <label for="captcha">{{ __('Captcha') }}</label>
        <div class="inline">
            <span id="captcha-content">{!! captcha_img() !!}</span>
            <button type="button" class="reload" id="reload">&#x21bb;</button>
        </div>
        <input id="captcha" name="captcha" type="text" placeholder="Enter Captcha">
        @error('captcha')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <button type="submit">
            {{ __('Save') }}
        </button>
    </form>
</div>

<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: '/reload_captcha',
            success: function (data) {
                $("#captcha-content").html(data.captcha);
            }
        });
    });
</script>
