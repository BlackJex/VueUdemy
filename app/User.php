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
    * The attributes that will be appended to the model
    *
    */
    protected $appends = [
      'url',
      'avatar'
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
         $this->_vote($vote_questions,$question, $vote);

       }

       public function voteAnswer(Answer $answer, $vote)
       {
         $vote_answers = $this->voteAnswers();
         $this->_vote($vote_answers,$answer, $vote);

       }

       private function _vote($relationship, $model, $vote){

         if($relationship->where('votable_id', $model->id)->exists())
         {
           $relationship->updateExistingPivot($model, ['vote' => $vote]);
         }else
         {
           $relationship->attach($model, ['vote' => $vote]);
         }

         $model->load('votes');
         $downVotes = (int) $model->downVotes()->sum('vote');
         $upVotes = (int) $model->upVotes()->sum('vote');

         $model->votes_count = $upVotes + $downVotes;
         $model->save();
       }

}
