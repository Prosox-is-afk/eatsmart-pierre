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
}
// $commandeController = new CommandeController();
// $commandeController->getAllCommandes();