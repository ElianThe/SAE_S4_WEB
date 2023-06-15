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
        return array_merge(
            $cat->toArray(),
            ['articles' => $cat->articles->toArray()]
        );
    }
}