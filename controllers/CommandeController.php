<?php

require_once "models/CommandeModel.php";

class CommandeController
/**
 * Classe CommandeController
 * 
 * Ce contrôleur gère les opérations liées aux commandes.
 * Il interagit avec le CommandeModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */

{
    private $model;

    public function __construct()
    {
        $this->model = new CommandeModel();
    }

    public function getAllCommandes()
    {
        $commandes = $this->model->getDBAllCommandes();
        echo json_encode($commandes);
    }

    public function getCommandeById($id)
    {
        $commande = $this->model->getDBCommandeById($id);
        echo json_encode($commande);
    }

    public function getArticlesByCommandes($id)
    {
        $details = $this->model->getDBArticlesByCommandes($id);
        echo json_encode($details);
    }

    public function createCommandes($data) {
        // Logique pour créer une nouvelle commande
        $newCommande = $this->model->createDBCommandes($data);
        if ($newCommande) {
            http_response_code(201); // Commande crée
            echo json_encode($newCommande);
        } else {
            http_response_code(400); // Erreur requête
            echo json_encode(["message" => "Erreur lors de la création de la commande."]);
        }
    }
}
// $commandeController = new CommandeController();
// $commandeController->getAllCommandes();