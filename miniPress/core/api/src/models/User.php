<?php

namespace miniPress\api\models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $hidden = [
        'password'
    ];

    public function articles() : HasMany
    {
        return $this->hasMany(Article::class, 'user_id');
    }
}