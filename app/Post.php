<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'short_description', 'long_description', 'featured_image'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function setFeaturedImageAtrribute(){
        $this->attributes['featured_image'] = asset($value);
    }
    public function getFeaturedImageAtrribute($value){
        return asset($value);
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
