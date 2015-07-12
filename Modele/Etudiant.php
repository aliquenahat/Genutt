<?php

require_once 'Modele/Modele.php';

class Etudiant extends Modele {

    public function vider() {
        $sql = 'TRUNCATE TABLE etu ';
        $this->executerRequete($sql);
    }

    public function ajouter($prenom, $nom, $programme, $semestre) {
        $sql = "SELECT COUNT(*) FROM etu WHERE prenom = ? AND nom = ?";
        $rep = $this->executerRequete($sql, array($prenom, $nom));
//On interdit les doublons
        if ($rep->fetchColumn() == 0) {
            $sql = 'INSERT INTO etu(prenom, nom, programme, semestre)  values(?, ?, ?, ?)';
            $this->executerRequete($sql, array($prenom, $nom, $programme, $semestre));
        } else {
            throw new Exception("Cet étudiant a déjà été ajouté.");
        }
    }

    public function ajouterListe($numero, $prenom, $nom, $programme, $semestre) {
        $sql = "SELECT COUNT(*) FROM etu WHERE prenom = ? AND nom = ?";
        $rep = $this->executerRequete($sql, array($prenom, $nom));
//On interdit les doublons
        if ($rep->fetchColumn() == 0) {
            $sql = 'INSERT INTO etu(numero, prenom, nom, programme, semestre)  values(?, ?, ?, ?, ?)';
            $this->executerRequete($sql, array($numero, $prenom, $nom, $programme, $semestre));
        } else {
            throw new Exception("Au moins un étudiant de la liste a déjà été ajouté.");
        }
    }

    public function attribuer($id_etu) {
        $sql = 'SELECT programme FROM etu WHERE numero=?';
        $retour = $this->executerRequete($sql, array($id_etu));
        $data = $retour->fetch();
        $sql = 'SELECT DISTINCT etu.nom nom_etu, etu.prenom prenom_etu, ec.nom nom_ec,ec.prenom prenom_ec, habilitation.id_ec id_ec, (count(etu.id_ec)-( SELECT count(etu.id_ec) FROM etu WHERE etu.id_ec IS NULL))as nbr 
            FROM habilitation, etu, ec
            WHERE (habilitation.id_ec = etu.id_ec OR etu.id_ec is NULL) AND habilitation.programme =? AND ec.id=habilitation.id_ec
            GROUP BY habilitation.id_ec 
            ORDER BY nbr ASC
            LIMIT 1';
        $retour = $this->executerRequete($sql, array($data['programme']));
        $req = $retour;
        $tab = $retour->fetch();
        if (empty($tab)) {
            throw new Exception("Aucun conseiller n'est habilité à conseiller au moins un étudiant. Veuillez verifier votre liste.");
        } else {
            $donnees = $this->executerRequete($sql, array($data['programme']))->fetch();
            $sql = 'UPDATE etu SET id_ec = :id_ec where numero = :id_etu';
            $this->executerRequete($sql, array('id_ec' => $donnees['id_ec'], 'id_etu' => $id_etu));
            return $donnees;
        }
    }

    public function supprimer($numero) {
        $sql = 'DELETE FROM etu WHERE numero=?';
        $this->executerRequete($sql, array($numero));
    }

    public function changerProgramme($id, $programme) {
        $sql = 'UPDATE etu SET programme = :programme, semestre=1 where numero = :id';
        $this->executerRequete($sql, array('programme' => $programme,'id' => $id));
    }

//On renvoi la liste des étudiants
    public function getEtudiant() {
        $sql = 'SELECT numero, prenom, nom, programme, semestre FROM etu ORDER BY nom';
        $etudiants = $this->executerRequete($sql);
        return $etudiants;
    }

//On renvoit la liste des étudiants du programme demandé    
    public function getEtudiantProg($programme) {
        $sql = 'SELECT numero, prenom, nom, programme, semestre FROM etu WHERE etu.programme= ? ORDER BY nom';
        $etudiants = $this->executerRequete($sql, array($programme));
        return $etudiants;
    }

//On envoi la liste des étudiants qui n'ont pas de conseiller
    public function getEtudiantSansC() {
        $sql = 'SELECT numero, prenom, nom, programme, semestre '
                . 'FROM etu '
                . 'WHERE id_ec IS NULL '
                . 'ORDER BY nom ';
        $etudiants = $this->executerRequete($sql);
        return $etudiants;
    }

    public function getEtudiantC($id) {
        $sql = 'SELECT etu.prenom prenom_etu, ec.nom nom_ec, etu.nom nom_etu, ec.prenom prenom_ec FROM etu,ec WHERE ec.id = etu.id_ec  AND etu.numero=? ORDER BY etu.nom ';
        $etudiants = $this->executerRequete($sql, array($id));
        return $etudiants;
    }

//On envoi la liste des étudiants qui sont en TC
    public function getAP() {
        $sql = 'SELECT numero, prenom, nom, programme, semestre FROM etu WHERE programme="TC" ORDER BY nom ';
        $etudiants = $this->executerRequete($sql);
        return $etudiants;
    }

//On envoi le programme du conseiller
    public function getProgrammeConseiller($id) {
        $sql = 'SELECT *
                FROM habilitation, etu
                WHERE habilitation.programme = etu.programme
                AND habilitation.id_ec = etu.id_ec
                AND etu.numero = ?';
        $retour = $this->executerRequete($sql, array($id));
        $resultat = $retour->fetch();
        if (empty($resultat)) {
            return false;
        } else {
            return true;
        }
    }

}

?>