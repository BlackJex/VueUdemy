<?php

namespace App;

use App\Question;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return Questions of the User.
     *
     *
     */
     public function questions(){
       return $this->hasMany(Question::class);
     }

     /**
      * favorites relation.
      *
      *
      */
      public function favorites(){
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
      }

     /**
      *
      * Return the Answers of the User.
      *
      */
     public function answers()
     {
       return $this->hasMany(Answer::class);
     }

     /**
      *
      * Return the questions votes of the User.
      *
      */
     public function voteQuestions()
     {
       return $this->morphedByMany(Question::class, 'votable');
     }
     /**
      *
      * Return the answers votes of the User.
      *
      */
     public function voteAnswers()
     {
       return $this->morphedByMany(Answer::class, 'votable');
     }

     /**
      *
      * get URL Attribute
      *
      */
      public function getUrlAttribute()
      {
        //return route('user.show', $this->id);
        return '#';
      }
      /**
       *
       * get URL Attribute
       *
       */
       public function getAvatarAttribute()
       {
         $email = $this->email;
         $size = 32;
         return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
       }

       public function voteQuestion(Question $question, $vote)
       {
         $vote_questions = $this->voteQuestions();

         if($vote_questions->where('votable_id', $question->id)->exists())
         {
           $vote_questions->updateExistingPivot($question, ['vote' => $vote]);
         }else
         {
           $vote_questions->attach($question, ['vote' => $vote]);
         }

         $question->load('votes');
         $downVotes = (int) $question->downVotes()->sum('vote');
         $upVotes = (int) $question->upVotes()->sum('vote');

         $question->votes_count = $upVotes + $downVotes;
         $question->save();
       }

       public function voteAnswer(Answer $answer, $vote)
       {
         $vote_answers = $this->voteAnswers();

         if($vote_answers->where('votable_id', $answer->id)->exists())
         {
           $vote_answers->updateExistingPivot($answer, ['vote' => $vote]);
         }else
         {
           $vote_answers->attach($answer, ['vote' => $vote]);
         }

         $answer->load('votes');
         $downVotes = (int) $answer->downVotes()->sum('vote');
         $upVotes = (int) $answer->upVotes()->sum('vote');

         $answer->votes_count = $upVotes + $downVotes;
         $answer->save();
       }

}
