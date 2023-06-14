<?php

namespace miniPress\admin\models;

class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Categories';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function articles(){
        return $this->hasMany(Article::class, 'cat_id');
    }

}