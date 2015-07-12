<?php

require_once 'Modele/Utilisateur.php';
require_once 'Vue/Vue.php';

class ControleurUtilisateur {

    private $utilisateur;

    public function __construct() {
        $this->utilisateur = new Utilisateur();
    }

    public function utilisateur() {
        if (!isset($_SESSION['identifiant'])) {
            $vue = new Vue("Utilisateur");
            $vue->afficher();
        } else {
            throw new Exception("Vous êtes déjà connecté.");
        }
    }

    //Affichage de la page d'accueil selon si l'utilisateur est connecté ou pas
    public function accueil() {
        if (isset($_SESSION['identifiant'])) {
            $vue = new Vue("Accueil");
        } else {
            $vue = new Vue("Visiteur");
        }
        $vue->afficher();
    }

    public function connexion($identifiant, $motDePasse, $categorie) {
        $utilisateur = $this->utilisateur->verifConnexion($identifiant, $motDePasse, $categorie);
        if ($utilisateur) {
            //Création des sessions pour la connexion
            $_SESSION['identifiant'] = $identifiant;
            $_SESSION['categorie'] = $categorie;
            //Redirection en javascript
            echo'<SCRIPT LANGUAGE="JavaScript">
            document.location.href="index.php"
            </SCRIPT>';
        } else {
            throw new Exception("Veuillez vérifiez vos entrées.");
        }
    }

    public function deconnexion() {
        //On déconnecte l'utilisateur en supprimant les sessions
        session_destroy();
        echo'<SCRIPT LANGUAGE="JavaScript">
        document.location.href="index.php"
        </SCRIPT>';
    }

}

?>