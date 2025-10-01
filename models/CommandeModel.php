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
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=eatsmart_bdd_pierre;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getDBAllCommandes()
    {
        $stmt = $this->pdo->query("SELECT * FROM commande");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$commande = new CommandeModel();
print_r($commande->getDBAllCommandes());
