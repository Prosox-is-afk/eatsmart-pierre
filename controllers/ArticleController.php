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
}
// $articleController = new ArticleController();
// $articleController->getAllArticles();