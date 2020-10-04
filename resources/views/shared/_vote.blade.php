@if( $model instanceof App\Question)
  @php
    $name = 'question';
    $first_uri_segment = 'question';
  @endphp
@elseif($model instanceof App\Answer)
  @php
    $name = 'answer';
    $first_uri_segment = 'answer';
  @endphp
@endif
@php
  $form_id = $name.'-'.$model->id;
  $form_action = '/'.$first_uri_segment.'/'.$model->id.'/vote';
@endphp
<div class="d-flex flex-column vote-controls">
  <a title="This {{ $name }} is useful"
     class="vote-up {{ Auth::guest() ? 'off' : '' }}"
     onclick="event.preventDefault(); document.getElementById('up-vote-{{ $form_id }}').submit();">
    <i class="fa fa-caret-up fa-3x"></i>
  </a>
  <form id="up-vote-{{ $form_id }}"class="d-none" action="{{ $form_action }}" method="post">
    @csrf
    <input type="text" class="d-none" name="vote" value="1">
  </form>
  <span class="votes-count">{{ $model->votes_count }}</span>
  <a title="This {{ $name }} is not useful"
     class="vote-down {{ Auth::guest() ? 'off' : '' }}"
     onclick="event.preventDefault(); document.getElementById('down-vote-{{ $form_id }}').submit();">
    <i class="fa fa-caret-down fa-3x"></i>
  </a>
  <form id="down-vote-{{ $form_id }}"class="d-none" action="{{ $form_action }}" method="post">
    @csrf
    <input type="text" class="d-none" name="vote" value="-1">
  </form>
  @if($model instanceof App\Question)
    @include('shared._favorite', [
    'model' => $model
    ])
  @elseif($model instanceof App\Answer)
    @include('shared._accept', [
    'model' => $model
    ])
  @endif
</div>
