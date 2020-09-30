<div class="media">
  <div class="d-flex flex-column vote-controls">
    <a title="This question is useful" class="vote-up">
      <i class="fa fa-caret-up fa-3x"></i>
    </a>
    <span class="votes-count">{{ $answer->votes_count }}</span>
    <a title="This question is not useful" class="vote-down">
      <i class="fa fa-caret-down fa-3x"></i>
    </a>
    <a class="vote-accept mt-2" title="Mark this answer as best answer">
      <i class="fa fa-check fa-2x"></i>
    </a>
  </div>
  <div class="media-body">
    {!! $answer->body_html !!}
    <div class="row">
      <div class="col-4">
        <div class="ml-auto ">
          @can('update', $answer)
          <a href="{{ route('question.answer.edit', [$question, $answer]) }}" class="btn btn-sm btn-outline-info my-2">{{ __('Edit') }}</a>
          @endcan
          @can('delete', $answer)
          <form class="form-delete my-2" action="{{ route('question.answer.destroy', [$question, $answer]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submti" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
          </form>
          @endcan
        </div>
      </div>
      <div class="col-4">

      </div>
      <div class="col-4">
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
</div>
<hr>
