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

}
