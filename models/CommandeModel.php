<?php

class CommandeModel
/**
 * Classe CommandeModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les commandes.
 * Il interagit avec le base de données pour récupérer les données
 * et retourne les résultats au controller.
 */
{
    private $pdo;

    public function __construct()
    /**
     * Constructeur de la classe CommandeModel.
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

    public function getDBAllCommandes()
        /**
    * Récupère toutes les commandes de la base de données.
    */
    {
        $stmt = $this->pdo->query("SELECT * FROM commande");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBCommandeById($id)
    /*
     * Récupère la commande {id} de la base de données.
     */
    {
        $sql = "SELECT * FROM commande WHERE id_commande = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// $commande = new CommandeModel();
// print_r($commande->getDBAllCommandes());
