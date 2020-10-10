@if($question->answers_count > 0)
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
            @include('answer._answer')
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endif
