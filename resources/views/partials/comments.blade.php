<hr>
<h1>
    Comments
</h1>
<hr class="thin">
@if($comments->isEmpty())
    <p>This post has no comments.</p>
@else
    @foreach($comments as $comment)
        <div class="inline">
            <h3><i>{{$comment->author}}</i>&ensp;</h3>
            <p class="small"><i>{{$comment->created_at}}</i></p>
        </div>
        <p class="wrap-anywhere">{{$comment->content}}</p>
        @if (\Illuminate\Support\Facades\Auth::check())
            <a class="invalid-feedback" href="{{ route('delete_comment', ['id' => $comment->id]) }}" onclick="return confirm('Are you sure?')">&#10006;&ensp;Delete comment</a>
            <hr>
        @endif
    @endforeach
@endif

<hr>
@include('comments.create')
