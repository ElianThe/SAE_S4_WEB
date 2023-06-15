<?php

namespace miniPress\admin\services\categorie;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use miniPress\admin\models\Categorie;

class CategorieService
{
    /**
     * @throws Exception
     */
    public function createCategorie(array $data): void
    {
        //filtre les données
        $nameFiltered= htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');

        //création de l'article
        if (isset($data['name'])) {
            $categorie = new Categorie();
            $categorie->name = $data['name'];
        } else {
            throw new Exception('Missing name in categorie creation');
        }

        //sauvegarde de la categorie
        $categorie->save();
    }

    //retourner les categories
    public function getCategories(): array
    {
        $categories = Categorie::all();
        return $categories->toArray();
    }



}