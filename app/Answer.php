<?php

namespace App;

use App\Question;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $fillable = [
    'body'
  ];

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

}
