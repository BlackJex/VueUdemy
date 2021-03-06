@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-items-center">
                    {{ __('Ask Question') }}
                    <div class="ml-auto">
                      <a href="{{ route('question.index') }}" class="btn btn-outline-secondary">{{ __('Back to All Questions') }}</a>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <form class="" action="{{ route('question.store') }}" method="post">
                    @include('question._form', [
                      'buttonText' => 'Ask question'
                    ])
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
