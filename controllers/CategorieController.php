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

    public function getCategorieById($id)
    {
        $categorie = $this->model->getDBCategorieById($id);
        echo json_encode($categorie);
    }

    public function getAllArticlesByCategorie($id)
    {
        $articles = $this->model->getDBAllArticlesByCategorie($id);
        echo json_encode($articles);
    }

    public function createCategorie($data)
    {
        // Logique pour créer une nouvelle categorie
        $newCategorie = $this->model->createDBCategorie($data);
        if ($newCategorie) {
            http_response_code(201); // Categorie crée
            echo json_encode($newCategorie);
        } else {
            http_response_code(400); // Erreur requête
            echo json_encode(["message" => "Erreur lors de la création de la categorie."]);
        }
    }

    public function updateCategorie($id, $data)
    {
        // Logique pour mettre à jour une categorie
        $updatedCategorie = $this->model->updateDBCategorie($id, $data);
        if ($updatedCategorie) {
            http_response_code(200); // Categorie mise à jour
        } else {
            http_response_code(400); // Erreur requête
            echo json_encode(["message" => "Erreur lors de la mise à jour de la categorie."]);
        }
    }

    public function deleteCategorie($id) {
        // Logique pour supprimer une categorie
        $deleted = $this->model->deleteDBCategorie($id);
        if ($deleted) {
            http_response_code(200); // Categorie supprimée
            echo json_encode(["message" => "Categorie supprimée avec succès."]);
        } else {
            http_response_code(404); // Categorie non trouvée
            echo json_encode(["message" => "Categorie non trouvée."]);
        }
    }
}
// $categorieController = new CategorieController();
// $categorieController->getAllCategories();