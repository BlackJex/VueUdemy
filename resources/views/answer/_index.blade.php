<div class="media">
  @include('shared._vote', [
    'model' => $answer
  ])
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
        @include('shared._author', [
          'model' => $answer,
          'label' => 'Answered'
        ])
      </div>
    </div>
  </div>
</div>
<hr>
