<?php

namespace miniPress\api\services\categories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\api\models\Categorie;

class CategoriesService
{
    public static function getCategories(): array
    {
        try {
            $categories = Categorie::all()->toArray();
        } catch (ModelNotFoundExceptio) {
            throw new CategorieNotFoundException();
        }
        return $categories;
    }

    public static function getCategorieById($id): array
    {
        try {
            $categorie = Categorie::where('id', $id)
                ->with(["articles" => function ($query) {
                    $query->with('user'); // Charger la relation 'user' pour chaque article
                }])->first()->toArray();
        } catch (ModelNotFoundException $e) {
            throw new CategorieNotFoundException();
        }
        return $categorie;
    }
}