<?php

class ArticleModel
/**
 * Classe ArticleModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les articles.
 * Il interagit avec le base de données pour récupérer les données
 * et retourne les résultats au controller.
 */
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_pierre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getDBAllArticles()
    {
        $stmt = $this->pdo->query("SELECT * FROM article");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$article = new ArticleModel();
print_r($article->getDBAllArticles());
