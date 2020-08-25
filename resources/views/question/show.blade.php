@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    <h1>{{ $question->title }}</h1>
                    <div class="ml-auto">
                      <a href="{{ route('question.index') }}" class="btn btn-outline-secondary">{{ __('Back to All Questions') }}</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
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
    <!-- Answers -->
    <div class="row mt-5 justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h2>{{ $question->answers_count." ".str_plural('Answer', $question->answers_count) }}</h2>
            </div>
            <hr>
            @foreach($question->answers as $answer)
              <div class="media">
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
            @endforeach
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
