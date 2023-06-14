<?php

namespace miniPress\api\models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'Articles';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function categorie() : BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}