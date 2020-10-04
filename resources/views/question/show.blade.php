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
                  @include('shared._vote', [
                    'model' => $question
                  ])
                  <div class="media-body">
                    {!! $question->body_html !!}
                    <div class="row">
                      <div class="col-4">

                      </div>
                      <div class="col-4">

                      </div>
                      <div class="col-4">
                        @include('shared._author', [
                          'model' => $question,
                          'label' => 'Asked'
                        ])
                      </div>
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
