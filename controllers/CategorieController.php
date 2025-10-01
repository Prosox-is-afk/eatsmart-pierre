<?php

require_once "models/CategorieModel.php";

class CategorieController
/**
 * Classe CategorieController
 * 
 * Ce contrôleur gère les opérations liées aux categories.
 * Il interagit avec le CategorieModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */

{
    private $model;

    public function __construct()
    {
        $this->model = new CategorieModel();
    }

    public function getAllCategories()
    {
        $categories = $this->model->getDBAllCategories();
        echo json_encode($categories);
    }
}
// $categorieController = new CategorieController();
// $categorieController->getAllCategories();