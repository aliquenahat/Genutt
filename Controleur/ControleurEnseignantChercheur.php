<?php

require_once 'Modele/EnseignantChercheur.php';
require_once 'Vue/Vue.php';

class ControleurEnseignantChercheur {

    private $enseignantChercheur;

    public function __construct() {
        $this->enseignantChercheur = new EnseignantChercheur();
    }

    //Les différents formulaires pour les traitementes
    public function formAjout() {
        //On affiche la page VueAjouterEC.php
        $vue = new Vue("AjouterEC");
        $vue->afficher();
    }

    public function formAjoutListe() {
        $vue = new Vue("AjouterListeEC");
        $vue->afficher();
    }

    public function formSuppression() {
        $enseignantChercheurs = $this->enseignantChercheur->getEC();
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun enseignant-chercheur.");
        } else {
            //On affiche la vue en lui faisant passer des paramètres
            $vue = new Vue("SupprimerEC");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getEC()));
        }
    }

    public function vide() {
        $this->enseignantChercheur->vider();
        //On appel alors la fonction qui va afficher le message
        $this->ok("Tout les enseignant-chercheurs ont bien été supprimés.");
    }

    //Traitement en faisant appel aux modèles
    public function visualisation() {
        $enseignantChercheurs = $this->enseignantChercheur->getEC();
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun EC présent dans la liste des conseillers.");
        } else {
            $vue = new Vue("Visualiser");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getEC()));
        }
    }

    public function visualisationE() {
        $enseignantChercheurs = $this->enseignantChercheur->getEtudiant();
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Aucun des EC ne conseille un étudiant.");
        } else {
            $vue = new Vue("VisualiserEcAvecEtudiant");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getEtudiant()));
        }
    }

    public function visualisationDec() {
        $enseignantChercheurs = $this->enseignantChercheur->getDec();
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun conseiller.");
        } else {
            $vue = new Vue("VisualiserDec");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getDec()));
        }
    }

    public function visualisationEtuAvecConseiller($programme) {
        $enseignantChercheurs = $this->enseignantChercheur->getEtuProg($programme);
        $tab = $enseignantChercheurs->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant.");
        } else {
            $vue = new Vue("VisualiserEtudiantAvecEc");
            $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getEtuProg($programme)));
        }
    }

    public function ajout($prenom, $nom, $bureau, $pole) {
        $this->enseignantChercheur->ajouter($prenom, $nom, $bureau, $pole);
        $this->ok("L'enseignant-chercheur a bien été ajouté.");
    }

    public function ajoutListe($file) {
        $chemin = pathinfo($file['name']);
        //On vérifie l'existence du fichier
        if (file_exists($chemin['dirname'])) {
            $tmp = $file['tmp_name'];
            //On vérifie si c'est bien un fichier csv
            if ($chemin['extension'] == "csv") {
                $row = 0;
                $handle = fopen($tmp, 'r');
                while (($data = fgetcsv($handle)) !== FALSE) {
                    $num = count($data);
                    $row++;
                    for ($c = 0; $c < $num; $c++) {
                        $case = explode(";", $data[$c]);
                        //On insère pas la première ligne du fichier
                        if ($row != 1) {
                            $this->enseignantChercheur->ajouterListe($case[0], $case[1], $case[2], $case[3]);
                        }
                    }
                }
            } else {
                throw new Exception("Ce n'est pas un fichier de type csv.");
            }
        } else {
            throw new Exception("Le fichier n'existe pas.");
        }
        $this->ok("La liste d'enseignant-chercheur a bien été ajouté.");
    }

    public function suppression($id) {
        $this->enseignantChercheur->supprimer($id);
        $this->ok("L'enseignant-chercheur a bien été supprimé.");
    }

    //Affichage de la réussite du traitement
    private function ok($msgOk) {
        $vue = new Vue("Ok");
        $vue->generer(array('msgOk' => $msgOk));
    }

}

?>