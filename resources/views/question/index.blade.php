@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    {{ __('All Questions') }}
                    <div class="ml-auto">
                      <a href="{{ route('question.create') }}" class="btn btn-outline-secondary">{{ __('Ask Question') }}</a>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  @forelse($questions as $question)
                    <div class="media">
                      <div class="d-flex flex-column counters">
                        <div class="vote">
                          <strong>{{ $question->votes }}</strong> {{ str_plural('vote', $question->votes) }}
                        </div>
                        <div class="status {{ $question->status }}">
                          <strong>{{ $question->answers }}</strong> {{ str_plural('answer', $question->answers) }}
                        </div>
                        <div class="view">
                        {{ $question->views . ' ' . str_plural('view', $question->views) }}
                        </div>
                      </div>
                      <div class="media-body">
                        <h3 class="mt-0">
                          <a href="{{ $question->url }}">{{ $question->title }}</a>
                        </h3>
                        <p class="lead">
                          Asked by
                          <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                          <small class="text-muted">{{ $question->created_date }}</small>
                        </p>
                        {{ str_limit($question->body, 250) }}
                      </div>
                    </div>
                    <hr>
                  @empty
                  {{ __('No Question Found') }}
                  @endforelse

                  {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
