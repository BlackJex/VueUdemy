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
                    @include('question._excerpt')
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
