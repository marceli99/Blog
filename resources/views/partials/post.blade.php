<h2><a href="{{ route('post', ['id' => $p->id]) }}">{{ __($p->name) }}</a></h2>
<small>{{$p->created_at}}</small>
@if ($p->hasImageAttached())
    <br>
    <img src="{{\Illuminate\Support\Facades\Storage::url($p->image)}}" alt="Image">
@endif
@if($fullContent)
    {{new \Illuminate\Support\HtmlString(Illuminate\Support\Str::markdown($p->content))}}
@else
    <p>{{strip_tags(\Illuminate\Support\Str::limit(Illuminate\Support\Str::markdown($p->content)))}}</p>
    <hr>
@endif
