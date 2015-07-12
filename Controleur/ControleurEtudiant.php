<?php

require_once 'Modele/Etudiant.php';
require_once 'Vue/Vue.php';

class ControleurEtudiant {

    private $etudiant;

    public function __construct() {
        $this->etudiant = new Etudiant();
    }

    public function vide() {
        $this->etudiant->vider();
        $this->ok("Tous les étudiants ont bien été supprimés.");
    }

    //Affichage des formulaires
    public function formAjout() {
        $vue = new Vue("AjouterEtudiant");
        $vue->afficher();
    }

    public function formAjoutListe() {
        $vue = new Vue("AjouterListeEtudiant");
        $vue->afficher();
    }

    public function formAttribution() {
        $etudiants = $this->etudiant->getEtudiantSansC();
        $tab = $etudiants->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant n'ayant pas de conseiller.");
        } else {
            //On affiche la vue en lui faisant passer des paramètres
            $vue = new Vue("Attribuer");
            $vue->generer(array('etudiants' => $this->etudiant->getEtudiantSansC()));
        }
    }

    public function formAttributionProgramme() {
        $etudiants = $this->etudiant->getAP();
        $tab = $etudiants->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant en TC.");
        } else {
            //On affiche la vue en lui faisant passer des paramètres
            $vue = new Vue("AttribuerProgramme");
            $vue->generer(array('etudiants' => $this->etudiant->getAP()));
        }
    }

    public function formSuppression() {
        $etudiants = $this->etudiant->getEtudiant();
        $tab = $etudiants->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant.");
        } else {
            $vue = new Vue("SupprimerEtudiant");
            $vue->generer(array('etudiants' => $this->etudiant->getEtudiant()));
        }
    }

    //Traitement
    public function visualisation() {
        $enseignantChercheurs = $this->enseignantChercheur->getEC();
        $vue = new Vue("Visualiser");
        $vue->generer(array('enseignantChercheurs' => $this->enseignantChercheur->getEC()));
    }

    public function visualisationEtu($programme) {
        $etudiants = $this->etudiant->getEtudiantProg($programme);
        $tab = $etudiants->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant.");
        } else {
            $vue = new Vue("VisualiserEtudiant");
            $vue->generer(array('etudiants' => $this->etudiant->getEtudiantProg($programme)));
        }
    }

    public function choixProgramme() {
        $vue = new Vue("ChoixProgramme");
        $vue->afficher();
    }

    public function choixProgrammeBis() {
        $vue = new Vue("ChoixProgrammeBis");
        $vue->afficher();
    }

    public function visualisationEtuSansConseiller() {
        $etudiants = $this->etudiant->getEtudiantSansC();
        $tab = $etudiants->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant n'ayant pas de conseiller.");
        } else {
            //On affiche la vue en lui faisant passer des paramètres
            $vue = new Vue("VisualiserEtudiantSansConseiller");
            $vue->generer(array('etudiants' => $this->etudiant->getEtudiantSansC()));
        }
    }

    public function ajout($nom, $prenom, $programme, $semestre) {
        $this->etudiant->ajouter($nom, $prenom, $programme, $semestre);
        $this->ok("L'étudiant a bien été ajouté.");
    }

    public function attribution($id) {
        $etudiant = $this->etudiant->attribuer($id);
        $vue = new Vue("AttribuerEtu");
        $vue->generer(array('etudiant' => $this->etudiant->attribuer($id)));
    }

    public function attributionTous() {
        $etudiants = $this->etudiant->getEtudiantSansC();
        $etudiants_copie = $this->etudiant->getEtudiantSansC();
        $tab = $etudiants->fetch();
        if (empty($tab)) {
            throw new Exception("Il n'y a aucun étudiant n'ayant pas de conseiller.");
        } else {
            $i = 0;
            $etus = "";
            foreach ($etudiants_copie as $etudiant) {
                $etudiantds = $this->etudiant->attribuer($etudiant['numero']);
                $retour = $this->etudiant->getEtudiantC($etudiant['numero']);
                $etudian = $retour->fetch();
                $etus .= "  <tr>  <td>" . ucfirst($etudian['prenom_etu']) . " " . strtoupper($etudian['nom_etu']) . "</td> <td>" . ucfirst($etudian['prenom_ec']) . " " . strtoupper($etudian['nom_ec']) . "   </tr>";
            }
            //On affiche la vue en lui faisant passer des paramètres
            $vue = new Vue("AttribuerTous");
            $vue->generer(array('etus' => $etus));
        }
    }

    public function attributionProgramme($id, $programme) {
        //On effectue le transfert du TC à la branche
     
        $this->etudiant->changerProgramme($id, $programme);
        //Si le conseiller de l'étudiant est habilitant au futur programme de l'étudiant en TC
        if ($this->etudiant->getProgrammeConseiller($id)) {
            $this->ok("Le conseiller de l'étudiant est habilité au programme où l'étudiant en TC souhaite aller,"
                    . " il n'est donc pas nécessaire de lui attribuer un nouveau conseiller. L'étudiant a bien été transféré.");
        }
        //Sinon on lui en attribue un qui est habilité à son programme
        else {
            $vue = new Vue("AttribuerEtu");
            $vue->generer(array('etudiant' => $this->etudiant->attribuer($id)));
        }
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
                            $this->etudiant->ajouterListe($case[0], $case[1], $case[2], $case[3], $case[4]);
                        }
                    }
                }
            } else {
                throw new Exception("Ce n'est pas un fichier de type csv.");
            }
        } else {
            throw new Exception("Le fichier n'existe pas.");
        }
        $this->ok("La liste des étudiants a bien été ajouté.");
    }

    public function suppression($numero) {
        $this->etudiant->supprimer($numero);
        $this->ok("L'étudiant a bien été supprimé.");
    }

    private function ok($msgOk) {
        $vue = new Vue("Ok");
        $vue->generer(array('msgOk' => $msgOk));
    }

}

?>