<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Permission;
class Role extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];
    public function permissions(){
        return $this->belongsToMany('App\Permission');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
