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
                  <vote :model="{{ $question }}" name="question"></vote>
                  <div class="media-body">
                    {!! $question->body_html !!}
                    <div class="row">
                      <div class="col-4">

                      </div>
                      <div class="col-4">

                      </div>
                      <div class="col-4">
                        <user-info :model="{{ $question }}" label="Asked"></user-info>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- Answers -->
    <answers :question="{{ $question }}"></answers>

    @include('answer._create', [
      'question' => $question
    ])
</div>
@endsection
