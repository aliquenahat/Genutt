<?php

require_once 'Modele/Modele.php';

class EnseignantChercheur extends Modele {

    public function vider() {
        $sql = 'TRUNCATE TABLE ec ';
        $this->executerRequete($sql);
        $sql = 'UPDATE etu SET id_ec = NULL';
        $this->executerRequete($sql);
    }

    public function ajouter($prenom, $nom, $bureau, $pole) {
        $sql = "SELECT COUNT(*) FROM ec WHERE prenom = ? AND nom = ?";
        $rep = $this->executerRequete($sql, array($prenom, $nom));
        //On vérifie qu'il n'est pas déjà présent pour éviter les doublons
        if ($rep->fetchColumn() == 0) {
            $sql = 'INSERT INTO ec(prenom, nom, bureau, pole)  values(?, ?, ?, ?)';
            $this->executerRequete($sql, array($prenom, $nom, $bureau, $pole));
            $this->ajouterHabilitation($nom, $prenom);
        } else {
            throw new Exception("L'enseignant-chercheur a déjà été ajouté.");
        }
    }

    public function ajouterListe($prenom, $nom, $bureau, $pole) {
        $sql = "SELECT COUNT(*) FROM ec WHERE prenom = ? AND nom = ?";
        $rep = $this->executerRequete($sql, array($prenom, $nom));
        //On vérifie qu'il n'est pas déjà présent pour éviter les doublons
        if ($rep->fetchColumn() == 0) {
            $sql = 'INSERT INTO ec(prenom, nom, bureau, pole)  values(?, ?, ?, ?)';
            $this->executerRequete($sql, array($prenom, $nom, $bureau, $pole));
            $this->ajouterHabilitation($nom, $prenom);
        } else {
            throw new Exception("Au moins un enseignant-chercheur de la liste a déjà été ajouté.");
        }
    }

    public function supprimer($id) {
        $sql = 'DELETE FROM ec WHERE id=?';
        $this->executerRequete($sql, array($id));
        $sql = 'UPDATE etu SET id_ec = NULL WHERE id_ec = ?';
        $this->executerRequete($sql, array($id));
    }

//Retour d'informations
    public function getEC() {
        $sql = 'SELECT id, prenom, nom, bureau, pole FROM ec ORDER BY nom';
        $enseignantChercheurs = $this->executerRequete($sql);
        return $enseignantChercheurs;
    }

    public function getECH() {
        $sql = 'SELECT ec.nom nom, ec.prenom prenom, ec.id id, ec.bureau bureau, ec.pole pole
                FROM ec
                INNER JOIN habilitation
                ON habilitation.id_ec = ec.id
                WHERE habilitation.programme = ?';
        $enseignantChercheurs = $this->executerRequete($sql, array($this->getProgramme()));
        return $enseignantChercheurs;
    }

    public function getEtudiant() {
        $sql = 'SELECT ec.nom nom_ec, ec.prenom prenom_ec, ec.id id_ec, etu.nom nom_etu, etu.prenom prenom_etu 
                FROM ec
                INNER JOIN etu
                ON etu.id_ec = ec.id';
        $enseignantChercheurs = $this->executerRequete($sql);
        return $enseignantChercheurs;
    }

    public function getEtuProg($programme) {
        $sql = 'SELECT ec.nom nom_ec, ec.prenom prenom_ec, ec.id id_ec, etu.nom nom_etu, etu.prenom prenom_etu 
                FROM ec
                INNER JOIN etu
                ON etu.id_ec = ec.id
                WHERE etu.programme = ?';
        $enseignantChercheurs = $this->executerRequete($sql, array($programme));
        return $enseignantChercheurs;
    }

    public function getNbEtu() {
        $sql = 'SELECT ec.nom nom_ec, ec.prenom prenom_ec, ec.id id_ec, COUNT(id_ec) as nb
                FROM ec
                INNER JOIN etu
                ON etu.id_ec = ec.id
                ORDER BY nb';
        $enseignantChercheurs = $this->executerRequete($sql);
        return $enseignantChercheurs;
    }

    public function getDec() {
        $sql = 'SELECT ec.prenom prenom_ec , ec.nom nom_ec ,count( etu.id_ec ) AS nb
                FROM ec, etu
                WHERE ec.id = etu.id_ec
                GROUP BY etu.id_ec
                ORDER BY nb DESC';
        $enseignantChercheurs = $this->executerRequete($sql);
        return $enseignantChercheurs;
    }

    private function ajouterHabilitation($nom, $prenom) {
        $sql = "SELECT id FROM ec WHERE prenom = ? AND nom = ?";
        $rep = $this->executerRequete($sql, array($prenom, $nom));
        $donnees = $rep->fetch();
        $sql = 'INSERT INTO habilitation(id_ec, programme)  values(?, "TC")';
        $rep = $this->executerRequete($sql, array($donnees['id']));
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