<?php

namespace App;

use App\Question;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $fillable = [
    'body',
    'user_id'
  ];

  /**
   *
   * get Created_Date Attribute
   *
   */
   public function getCreatedDateAttribute()
   {
     return $this->created_at->diffForHumans();
   }

  /**
   *
   * Return the Question related to the Answer.
   *
   */
  public function question()
  {
    return $this->belongsTo(Question::class);
  }


  /**
   *
   * Return the User owner of the Answer.
   *
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function isBest()
  {
    return $this->id == $this->question->best_answer_id;
  }

  /**
   *
   * Return the Users that vote this Answer.
   *
   */
  public function votes()
  {
    return $this->morphToMany(User::class, 'votable');
  }

  /**
   *
   * get body_html Attribute
   *
   */
  public function getBodyHtmlAttribute()
  {
    return \Parsedown::instance()->text($this->body);
  }

  /**
   *
   * get status Attribute
   *
   */
  public function getStatusAttribute()
  {
     return $this->isBest() ? 'vote-accept' : '';
  }
  /**
   *
   * get is_best Attribute
   *
   */
  public function getIsBestAttribute()
  {
    return $this->isBest();
  }

  /**
   *
   * execute the following code when an answer method is invoked
   *
   */
   public static function boot()
   {
     parent::boot();
     static::created(function($answer){
       //increment the answer count when a new answer is created
        $answer->question->increment('answers_count');
     });

     static::deleted(function($answer){

       //decrement the answer count when an answer is deleted
        $answer->question->decrement('answers_count');

     });

   }

   public function upVotes()
   {
     return $this->votes()->wherePivot('vote', 1);
   }

   public function downVotes()
   {
     return $this->votes()->wherePivot('vote', -1);
   }
}
