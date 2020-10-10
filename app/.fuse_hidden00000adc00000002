<?php

namespace App;

use App\User;
use App\Answer;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  use VotableTrait;

    protected $fillable = [
      'title',
      'body'
    ];

    /**
     *
     * Return the Owner of the Question.
     *
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    /**
     * favorites relation.
     *
     *
     */
     public function favorites()
     {
       return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
     }

     public function isFavorited()
     {
       return $this->favorites()->where('user_id', auth()->user()->id)->count() > 0;
     }

     public function getIsFavoritedAttribute()
     {
       return $this->isFavorited();
     }

     public function getFavoritesCountAttribute()
     {
       return $this->favorites()->count();
     }

    /**
     *
     * Return the Answers related to the Question.
     *
     */
    public function answers()
    {
      return $this->hasMany(Answer::class);
    }

    /**
     *
     * Set the Slug of the Question.
     *
     */
    public function setTitleAttribute($value)
    {
      $this->attributes['title'] = $value;
      $this->attributes['slug'] = str_slug($value);
    }
    /**
     *
     * Set the Body of the Question.
     *
     */
    /*public function setBodyAttribute($value)
    {
      $this->attribute['body'] = clean($value);
    }*/
    /**
     *
     * get URL Attribute
     *
     */
     public function getUrlAttribute()
     {
       return route('question.show', $this->slug);
     }

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
       * get Status Attribute
       *
       */
       public function getStatusAttribute()
       {
         if( $this->answers_count > 0)
         {
           if($this->best_answer_id)
           {
             return 'answered-accepted';
           }
           return 'answered';
         }else{
           return 'unanswered';
         }
       }

       private function bodyHtml()
       {
         return \Parsedown::instance()->text($this->body);
       }

       public function excerpt($length)
       {
         return str_limit(strip_tags($this->bodyHtml()), $length);
       }
       /**
        *
        * get body_html Attribute
        *
        */
       public function getBodyHtmlAttribute()
       {
         return clean($this->bodyHtml());
       }
       public function getExcerptAttribute()
       {
         return $this->excerpt(250);
       }

       public function acceptBestAnswer(Answer $answer){
         $this->best_answer_id = $answer->id;
         $this->save();
       }
 }
