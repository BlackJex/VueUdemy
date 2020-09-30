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
   * execute the following code when an answer is created
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
       //increment the answer count when a new answer is created
        $answer->question->decrement('answers_count');
     });

   }
}
