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
                    @csrf
                      <div class="form-group">
                        <label for="question-title">Question Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" id="question-title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

                        @if($errors->has('title'))
                          <div class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                          </div>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="question-body">Explain yout question</label>
                        <textarea value="{{ old('body') }}" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="question-body" rows="10" cols="80"></textarea>

                        @if($errors->has('body'))
                          <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                          </div>
                        @endif
                      </div>

                      <div class="form-group text-center">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Ask this question</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
