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
                  @include('layouts._messages')

                  @forelse($questions as $question)
                    <div class="media">
                      <div class="d-flex flex-column counters">
                        <div class="vote">
                          <strong>{{ $question->votes_count }}</strong> {{ str_plural('vote', $question->votes_count) }}
                        </div>
                        <div class="status {{ $question->status }}">
                          <strong>{{ $question->answers_count }}</strong> {{ str_plural('answer', $question->answers_count) }}
                        </div>
                        <div class="view">
                        {{ $question->views . ' ' . str_plural('view', $question->views) }}
                        </div>
                      </div>
                      <div class="media-body">
                        <div class="d-flex align-items-center">
                          <h3 class="mt-0">
                            <a href="{{ $question->url }}">{{ $question->title }}</a>
                          </h3>
                          @auth
                            <div class="ml-auto ">
                              @can('update', $question)
                              <a href="{{ route('question.edit', $question) }}" class="btn btn-sm btn-outline-info my-2">{{ __('Edit') }}</a>
                              @endcan
                              @can('delete', $question)
                              <form class="form-delete my-2" action="{{ route('question.destroy', $question) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submti" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                              </form>
                              @endcan

                            </div>
                          @endauth
                        </div>
                        <p class="lead">
                          Asked by
                          <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                          <small class="text-muted">{{ $question->created_date }}</small>
                        </p>
                        <div class="excerpt">
                          {{ $question->excerpt }}
                        </div>
                      </div>
                    </div>
                    <hr>
                  @empty
                    <div class="alert alert-warning">
                      <strong>Sorry</strong> {{ __('No question found.') }}
                    </div>
                  @endforelse

                  {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
