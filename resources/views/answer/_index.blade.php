<div class="media">
  <div class="d-flex flex-column vote-controls">
    <a title="This question is useful" class="vote-up">
      <i class="fa fa-caret-up fa-3x"></i>
    </a>
    <span class="votes-count">{{ $answer->votes_count }}</span>
    <a title="This question is not useful" class="vote-down">
      <i class="fa fa-caret-down fa-3x"></i>
    </a>
    @can('accept', $answer)
      <a class="{{ $answer->status }} mt-2 cursor-pointer"
        title="Mark this answer as best answer"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
        <i class="fa fa-check fa-2x"></i>
      </a>
      <form id="accept-answer-{{ $answer->id }}"class="d-none" action="{{ route('answer.accept', $answer->id) }}" method="post">
        @csrf
      </form>
    @else
      @if($answer->is_best)
      <a class="{{ $answer->status }} mt-2"
        title="Accepted Answer">
        <i class="fa fa-check fa-2x"></i>
      </a>
      @endif
    @endcan
  </div>
  <div class="media-body">
    {!! $answer->body_html !!}
    <div class="float-right">
      <span class="text-muted">
        {{ $answer->created_date }}
        <div class="media mt-2">
          <a href="{{ $answer->user->url }}" class="pr-2">
            <img src="{{ $answer->user->avatar  }}" alt="{{ $answer->user->name }}">
          </a>
          <div class="media-body mt-1">
            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
          </div>
        </div>
      </span>
    </div>
  </div>
</div>
<hr>
