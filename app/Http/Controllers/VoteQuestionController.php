<?php

namespace App\Http\Controllers;

use App\User;
use App\Question;

use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function __invoke(Question $question)
  {
    $vote = (int) request()->vote;

    $votes_count = auth()->user()->voteQuestion($question, $vote);
    if(request()->expectsJson())
    {
      return response()->json([
        'message' => 'Thanks for the feedback',
        'votesCount' => $votes_count
      ]);
    }
    return back();
  }
}
