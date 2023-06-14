<?php

namespace miniPress\api\models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function articles() : HasMany
    {
        return $this->hasMany(Article::class, 'cat_id');
    }

}