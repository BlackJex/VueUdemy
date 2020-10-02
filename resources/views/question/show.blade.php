@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <div class="d-flex align-items-center">
                    <h1>{{ $question->title }}</h1>
                    <div class="ml-auto">
                      <a href="{{ route('question.index') }}" class="btn btn-outline-secondary">{{ __('Back to All Questions') }}</a>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="media">
                  <div class="d-flex flex-column vote-controls">
                    <a title="This question is useful" class="vote-up">
                      <i class="fa fa-caret-up fa-3x"></i>
                    </a>
                    <span class="votes-count">{{ $question->votes }}</span>
                    <a title="This question is not useful" class="vote-down">
                      <i class="fa fa-caret-down fa-3x"></i>
                    </a>
                    <a class="favorite mt-2 @auth() {{ $question->is_favorited ? 'favorited' : '' }} @endauth"
                      title="Click to mark as favorite (click again to undo)"
                      onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();">
                      <i class="fa fa-star fa-2x"></i>
                    </a>
                    <form id="favorite-question-{{ $question->id }}"class="d-none" action="/question/{{ $question->id }}/favorites" method="post">
                      @csrf
                      @auth()
                        @if($question->is_favorited)
                          @method('DELETE')
                        @endif
                      @endauth
                    </form>
                    <span class="favorites-count">{{ $question->favorites_count }}</span>
                  </div>
                  <div class="media-body">
                    {!! $question->body_html !!}
                    <div class="float-right">
                      <span class="text-muted">
                        {{ $question->created_date }}
                        <div class="media mt-2">
                          <a href="{{ $question->user->url }}" class="pr-2">
                            <img src="{{ $question->user->avatar  }}" alt="{{ $question->user->name }}">
                          </a>
                          <div class="media-body mt-1">
                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                          </div>
                        </div>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- Answers -->
    <div class="row mt-5 justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h2>{{ $question->answers_count." ".str_plural('Answer', $question->answers_count) }}</h2>
            </div>
            <hr>
            @include('layouts._messages')

            @foreach($question->answers as $answer)
              @include('answer._index',[
                'answer' => $answer
              ])
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @include('answer._create', [
      'question' => $question
    ])
</div>
@endsection
