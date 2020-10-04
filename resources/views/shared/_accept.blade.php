@can('accept', $model)
  <a class="{{ $model->status }} mt-2 cursor-pointer"
    title="Mark this answer as best answer"
    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();">
    <i class="fa fa-check fa-2x"></i>
  </a>
  <form id="accept-answer-{{ $model->id }}"class="d-none" action="{{ route('answer.accept', $model->id) }}" method="post">
    @csrf
  </form>
@else
  @if($model->is_best)
  <a class="{{ $model->status }} mt-2"
    title="Accepted Answer">
    <i class="fa fa-check fa-2x"></i>
  </a>
  @endif
@endcan
