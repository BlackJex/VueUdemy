<div class="row mt-5 justify-content-center">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3>{{ __('Your Answer') }}</h3>
        </div>
        <hr>
      </div>
      <form class="px-4" action="{{ route('question.answer.store', $question) }}" method="post">
        @csrf
        <div class="form-group">
          <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" rows="7"></textarea>
          @if($errors->has('body'))
            <div class="invalid-feedback">
              <strong>{{ $errors->first('body') }}</strong>
            </div>
          @endif
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-lg btn-outline-primary" name="button">{{ _('Publish') }}</button>
        </div>
      </form>
    </div>
  </div>
</div>
<hr>
