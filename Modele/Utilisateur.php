<?php

require_once 'Modele/Modele.php';

class Utilisateur extends Modele {

    //Retourne un booléen selon le résultat de l'authentifaction de l'utilisateur
    public function verifConnexion($identifiant, $motDePasse, $categorie) {

        $motDePasse_crypte = sha1($motDePasse);
        $sql = 'SELECT id,categorie,identifiant FROM utilisateur WHERE identifiant = ? AND motdepasse = ? AND categorie = ?';
        $req = $this->executerRequete($sql, array($identifiant, $motDePasse_crypte, $categorie));
        $resultat = $req->fetch();
        if ($resultat) {
            return true;
        } else {
            return false;
        }
    }

}

?>