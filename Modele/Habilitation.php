<?php

require_once 'Modele/Modele.php';

class Habilitation extends Modele {

    private $programme;

    public function ajouter($id) {
        $sql = "SELECT COUNT(*) FROM habilitation WHERE id_ec = ? AND programme = ?";
        $rep = $this->executerRequete($sql, array($id, $this->getProgramme()));
        //Pas de doublons
        if ($rep->fetchColumn() == 0) {
            $sql = 'INSERT INTO habilitation(id_ec, programme)  VALUES(?, ?)';
            $this->executerRequete($sql, array($id, $this->getProgramme()));
        } else {
            throw new Exception("L'enseignant a déjà été habilité.");
        }
    }

    public function supprimer($id) {
        $sql = "DELETE FROM habilitation WHERE id_ec = ? AND programme = ?";
        $rep = $this->executerRequete($sql, array($id, $this->getProgramme()));
    }

    public function ajouterPole($pole) {

        $sql = 'SELECT id FROM ec WHERE pole = ?';
        $req = $this->executerRequete($sql, array($pole));
        while ($donnees = $req->fetch()) {
            $sql = "SELECT COUNT(*) FROM habilitation WHERE id_ec = ? AND programme = ?";
            $rep = $this->executerRequete($sql, array($donnees['id'], $this->getProgramme()));
            //Pas de doublons
            if ($rep->fetchColumn() == 0) {
                $sql = 'INSERT INTO habilitation(id_ec, programme)  VALUES(?, ?)';
                $this->executerRequete($sql, array($donnees['id'], $this->getProgramme()));
            } else {
                throw new Exception("Au moins un enseignant a déjà été habilité.");
            }
        }
    }

    public function visualiser() {
        $sql = 'SELECT etu.nom nom_etu, etu.prenom prenom_etu, ec.prenom prenom_ec, ec.nom nom_ec
                FROM etu
                INNER JOIN ec
                ON etu.id_ec = ec.id      
                WHERE etu.programme = ?';
        $etudiants = $this->executerRequete($sql, array($this->getProgramme()));
        return $etudiants;
    }

    //Retourne le programme du responsable
    private function getProgramme() {
        $sql = 'SELECT programme FROM utilisateur WHERE identifiant = ?';
        $donnees = $this->executerRequete($sql, array($_SESSION['identifiant']));
        $donnees = $donnees->fetch();
        $this->programme = $donnees['programme'];
        return $this->programme;
    }

}

?>