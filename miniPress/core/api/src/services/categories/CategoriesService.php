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
        $cat = Categorie::find($id);
        if($cat){
            $result = $cat->toArray();
            $result["articles"] = $cat->articles->toArray() ;
            return $result;
        } else {
            return [];
        }
    }
}