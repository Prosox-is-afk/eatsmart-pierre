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
    /**
     * Constructeur de la classe ArticleModel.
     * Initialise une connexion à la base de données en utilisant PDO.
     * En cas d'échec, une erreur est affichée et le script s'arrête.
    */
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_pierre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getDBAllArticles()
    /*
    * Récupère tous les articles de la base de données.
    */
    {
        $stmt = $this->pdo->query("SELECT * FROM article");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBArticleById($id) 
    /*
    * Récupère l'article {id} de la base de données.
    */
    {
        $sql = "SELECT * FROM article WHERE id_article = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDBAllCommandesByArticle($id)
    /**
     * Récupère toutes les commandes d'un article spécifique de la base de données.
     */
    {
        $sql = "SELECT a.nom, ac.*, c.date_commande, c.prix_total, c.etat FROM assoc_article_commande ac 
                INNER JOIN article a ON a.id_article = ac.id_article
                INNER JOIN commande c ON c.id_commande = ac.id_commande
                WHERE ac.id_article = :id"
        ;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDBArticle($data)
    {
        $sql = "INSERT INTO article (id_article, nom, prix, description , id_categorie) VALUES (:id_article, :nom, :prix, :description, :id_categorie)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_article', $data['id_article'], PDO::PARAM_INT);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prix', $data['prix'], PDO::PARAM_INT);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':id_categorie', $data['id_categorie'], PDO::PARAM_INT);
        $stmt->execute();

        return $this->getDBArticleById($data['id_article']);
    }

    public function deleteDBArticle($id)
    {
        $sql = "DELETE FROM article WHERE id_article = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function updateDBArticle($id, $data)
    {
        $sql = "UPDATE article SET id_article = :id_article, nom = :nom, prix = :prix, description = :description, id_categorie = :id_categorie WHERE id_article = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_article', $data['id_article'], PDO::PARAM_INT);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prix', $data['prix'], PDO::PARAM_INT);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':id_categorie', $data['id_categorie'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}

// $article = new ArticleModel();
// print_r($article->getDBAllArticles());
