<?php

require_once "models/ArticleModel.php";

class ArticleController
/**
 * Classe ArticleController
 * 
 * Ce contrôleur gère les opérations liées aux articles.
 * Il interagit avec le ArticleModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */

{
    private $model;

    public function __construct()
    {
        $this->model = new ArticleModel();
    }

    public function getAllArticles()
    {
        $articles = $this->model->getDBAllArticles();
        echo json_encode($articles);
    }

    public function getArticleById($id)
    {
        $article = $this->model->getDBArticleById($id);
        echo json_encode($article);
    }

    public function getAllCommandesByArticle($id)
    {
        $commandes = $this->model->getDBAllCommandesByArticle($id);
        echo json_encode($commandes);
    }

    public function createArticle($data)
    {
        // Logique pour créer un nouvel article
        $newArticle = $this->model->createDBArticle($data);
        if ($newArticle) {
            http_response_code(201); // Article crée
            echo json_encode($newArticle);
        } else {
            http_response_code(400); // Erreur requête
            echo json_encode(["message" => "Erreur lors de la création de l'article."]);
        }
    }

    public function deleteArticle($id)
    {
        // Logique pour supprimer un article
        $deleted = $this->model->deleteDBArticle($id);
        if ($deleted) {
            http_response_code(200); // Article supprimé
            echo json_encode(["message" => "Article supprimé avec succès."]);
        } else {
            http_response_code(404); // Article non trouvé
            echo json_encode(["message" => "Article non trouvé."]);
        }
    }
}
// $articleController = new ArticleController();
// $articleController->getAllArticles();