<?php

abstract class Modele {

    private $bdd;

    //On va simplifier les requetes 
    protected function executerRequete($sql, $params = null) {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql); // exécution directe
        } else {
            $resultat = $this->getBdd()->prepare($sql);  // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    //On se connecte à la bdd
    private function getBdd() {
        if ($this->bdd == null) {
            // Création de la connexion
            $this->bdd = new PDO('mysql:host=localhost;dbname=genutt;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }

}

?>