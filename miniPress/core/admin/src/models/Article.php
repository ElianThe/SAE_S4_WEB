<?php

namespace miniPress\admin\models;

class Article extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Articles';
    protected $primaryKey = 'id';
    public $timestamps = false;



    public function categorie(){
        return $this->belongsTo(Categorie::class, 'cat_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}