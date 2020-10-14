<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

use Illuminate\Http\Request;

class AnswerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {

      $question->answers()->create($request->validate([
        'body' => 'required'
      ]) + ['user_id' => auth()->user()->id]);

      return back()->with('success', __('Your answer has been published!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answer._edit', compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
          'body' => 'required',
        ]));

        if($request->expectsJson())
        {
          return response()->json([
            'message' => 'Your Answer has been updated',
            'body_html' => $answer->body_html
          ]);
        }

        return redirect()->route('question.show', $question->slug)->with('success', __('Your Answer has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if(request()->expectsJson())
        {
          return response()->json([
            'message' => 'Your Answer has been removed'
          ]);
        }
        return redirect()->back()->with('success', __('Your Answer has been deleted'));

    }
}
