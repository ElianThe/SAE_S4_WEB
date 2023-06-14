<?php

namespace miniPress\api\services\categories;

use miniPress\api\models\Categorie;

class CategoriesService
{
    public function getCategories(): array
    {
        $categories = Categorie::all();
        return $categories->toArray();
    }
}