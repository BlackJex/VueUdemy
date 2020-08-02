@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  {{ __('All Questions') }}
                </div>

                <div class="card-body">
                  @forelse($questions as $question)
                    <div class="media">
                      <div class="media-body">
                        <h3 class="mt-0">{{ $question->title }}</h3>
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
