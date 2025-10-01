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
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_pierre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getDBAllCategories()
    {
        $stmt = $this->pdo->query("SELECT * FROM categorie");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$categorie = new CategorieModel();
print_r($categorie->getDBAllCategories());
