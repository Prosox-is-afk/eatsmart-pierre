<?php

class CategorieModel
/**
 * Classe CategorieModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les categories.
 * Il interagit avec le base de données pour récupérer les données
 * et retourne les résultats au controller.
 */
{
    private $pdo;

    public function __construct()
        /**
     * Constructeur de la classe CategorieModel.
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

    public function getDBAllCategories()
        /**
    * Récupère toutes les catégories de la base de données.
    */
    {
        $stmt = $this->pdo->query("SELECT * FROM categorie");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBCategorieById($id) 
    /**
    * Récupère la catégorie {id} de la base de données.
    */
    {
        $sql = "SELECT * FROM categorie WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDBAllArticlesByCategorie($id)
    /**
     * Récupère tous les articles d'une catégorie spécifique de la base de données.
     */
    {
        $sql = "SELECT * FROM article WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDBCategorie($data) {
        /**
         * Crée une nouvelle catégorie dans la base de données.
         */
        $sql = "INSERT INTO categorie (id_categorie, nom) VALUES (:id_categorie, :nom)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_categorie', $data['id_categorie'], PDO::PARAM_INT);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->execute();

        return $this->getDBCategorieById($data['id_categorie']);
    }

    public function updateDBCategorie($id, $data) {
        /**
         * Met à jour une catégorie existante dans la base de données.
         */
        $sql = "UPDATE categorie SET id_categorie = :id_categorie, nom = :nom WHERE id_categorie = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_categorie', $data['id_categorie'], PDO::PARAM_INT);
        $stmt->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}

// $categorie = new CategorieModel();
// print_r($categorie->getDBAllCategories());
