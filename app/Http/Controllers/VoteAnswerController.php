<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function __invoke(Answer $answer)
  {
    $vote = (int) request()->vote;

    $votes_count = auth()->user()->voteAnswer($answer, $vote);
    
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
