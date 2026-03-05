<?php

class DefaultController extends AbstractController
{
    public function index() : void
    {
        // Créer le manager
        $userManager = new UserManager();

        // Récupérer tous les utilisateurs
        $users = $userManager->findAll();

        // ----- DEBUG RAPIDE -----
        echo '<pre>';
        var_dump($users); // Affiche tous les objets User avec toutes leurs propriétés
        echo '</pre>';

        // ----- ENVOI À LA VUE -----
        $this->render("index", [
            "users" => $users
        ]);
    }
}