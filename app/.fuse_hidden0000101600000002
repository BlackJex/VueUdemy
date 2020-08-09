<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

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
     * get URL Attribute
     *
     */
     public function getUrlAttribute()
     {
       return route('question.show', $this->id);
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

 }
