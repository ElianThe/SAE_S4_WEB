<?php

namespace miniPress\admin\models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function articles(){
        return $this->hasMany(Article::class, 'user_id');
    }
}