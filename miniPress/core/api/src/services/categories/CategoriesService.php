<?php

namespace miniPress\api\services\categories;

use miniPress\api\models\Categorie;

class CategoriesService
{
    public static function getCategories(): array
    {
        return Categorie::all()->toArray();
    }

    public static function getCategorieById($id): array
    {
        return Categorie::where('id', $id)->with("articles")->first()->toArray();
    }
}