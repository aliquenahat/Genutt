<?php

require_once 'Modele/Habilitation.php';
require_once 'Modele/EnseignantChercheur.php';
require_once 'Vue/Vue.php';

class ControleurHabilitation {

    private $habilitation;
    private $enseignantChercheur;

    public function __construct() {
        $this->habilitation = new Habilitation();
        $this->enseignantChercheur = new EnseignantChercheur();
    }

    //Affichage des formulaires
    public function formAjout() {
        $enseignantChercheurs = $this->enseignantChercheur->getEC();
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun enseignant-chercheur.");
        } else {
            $vue = new Vue("AjouterHabilitation");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getEC()));
        }
    }

    public function formAjoutPole() {
        $vue = new Vue("AjouterHPole");
        $vue->afficher();
    }

    public function formSuppression() {
        $enseignantChercheurs = $this->enseignantChercheur->getECH();
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun enseignant-chercheur habilité pour votre programme.");
        } else {
            $vue = new Vue("SupprimerHabilitation");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getECH()));
        }
    }

    //Traitement
    public function ajout($id
    ) {
        $this->habilitation->ajouter($id);
        $this->ok("L'habilitation a bien été ajouté.");
    }

    public function ajoutPole($pole) {
        $this->habilitation->ajouterPole($pole);
        $this->ok("Les habilitations par pôle ont été effectuées.");
    }

    public function visualisation() {
        $habilitations = $this->habilitation->visualiser();
        $tab = $habilitations->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun enseignant-chercheur habilité pour votre programme qui conseille un étudiant.");
        } else {
            $vue = new Vue("VisualiserHabilitation");
            $vue->generer(array('habilitations' => $this->habilitation->visualiser()));
        }
    }

    public function suppression($id) {
        $this->habilitation->supprimer($id);
        $this->ok("L'habilitation a bien été supprimé.");
    }

    private function ok($msgOk) {
        $vue = new Vue("Ok");
        $vue->generer(array('msgOk' => $msgOk));
    }

}

?>