<a class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}"
  title="Click to mark as favorite (click again to undo)"
  onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();">
  <i class="fa fa-star fa-2x"></i>
</a>
<form id="favorite-question-{{ $model->id }}"class="d-none" action="/{{ $first_uri_segment }}/{{ $model->id }}/favorites" method="post">
  @csrf
  @auth()
    @if($model->is_favorited)
      @method('DELETE')
    @endif
  @endauth
</form>
<span class="favorites-count">{{ $model->favorites_count }}</span>
