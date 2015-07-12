<?php

require_once 'Controleur/ControleurHabilitation.php';
require_once 'Controleur/ControleurUtilisateur.php';
require_once 'Controleur/ControleurEnseignantChercheur.php';
require_once 'Controleur/ControleurEtudiant.php';
require_once 'Vue/Vue.php';

class Routeur {

    private $ctrlUtilisateur;
    private $ctrlEnseignantChercheur;
    private $ctrlHabilitation;
    private $ctrlEtudiant;

    public function __construct() {
        $this->ctrlEnseignantChercheur = new ControleurEnseignantChercheur();
        $this->ctrlUtilisateur = new ControleurUtilisateur();
        $this->ctrlHabilitation = new ControleurHabilitation();
        $this->ctrlEtudiant = new ControleurEtudiant();
    }

    // Traite une requête entrante
    public function routerRequete() {
        //On va pointer vers une méthode d'un controleur selon l'url entré (paramètres GET)
        try {
            if (isset($_GET['categorie'])) {
                if ($_GET['categorie'] == "drh") {
                    //On vérifie que l'utilisateur est bien un drh grâce à sa session crée lors de la connexion
                    if ($_SESSION['categorie'] == "drh") {
                        if (isset($_GET['action'])) {
                            if ($_GET['action'] == 'formajout') {
                                $this->ctrlEnseignantChercheur->formAjout();
                            } else if ($_GET['action'] == 'formajoutliste') {
                                $this->ctrlEnseignantChercheur->formAjoutListe();
                            } else if ($_GET['action'] == 'formsuppression') {
                                $this->ctrlEnseignantChercheur->formSuppression();
                            } elseif ($_GET['action'] == 'vide') {
                                $this->ctrlEnseignantChercheur->vide();
                            } else if ($_GET['action'] == 'ajout') {
                                $prenom = $this->getParametre($_POST, 'prenom');
                                $nom = $this->getParametre($_POST, 'nom');
                                $bureau = $this->getParametre($_POST, 'bureau');
                                $pole = $this->getParametre($_POST, 'pole');
                                $this->ctrlEnseignantChercheur->ajout($prenom, $nom, $bureau, $pole);
                            } else if ($_GET['action'] == 'ajoutliste') {
                                $file = $_FILES["fichier"];
                                $this->ctrlEnseignantChercheur->ajoutListe($file);
                            } else if ($_GET['action'] == 'visualisation') {
                                $this->ctrlEnseignantChercheur->visualisation();
                            } else if ($_GET['action'] == 'visualisationetu') {
                                $this->ctrlEnseignantChercheur->visualisationE();
                            } else if ($_GET['action'] == 'visualisationdec') {
                                $this->ctrlEnseignantChercheur->visualisationDec();
                            } else if ($_GET['action'] == 'suppression') {
                                $id = $this->getParametre($_POST, 'id');
                                $this->ctrlEnseignantChercheur->suppression($id);
                            } else if ($_GET['action'] == 'vide') {
                                $this->ctrlEnseignantChercheur->vide($id);
                            } else {
                                throw new Exception("Action non valide.");
                            }
                        } else {  // Si aucune action définie affichage de l'accueil
                            $this->ctrlUtilisateur->accueil();
                        }
                    } else {
                        throw new Exception("Vous n'avez pas le droit d'accéder à cette page.");
                    }
                } else if ($_GET['categorie'] == "responsable") {
                    if ($_SESSION['categorie'] == "responsable") {
                        if ($_GET['action'] == "formajout") {
                            $this->ctrlHabilitation->formAjout();
                        } else if ($_GET['action'] == "formsuppression") {
                            $this->ctrlHabilitation->formSuppression();
                        } else if ($_GET['action'] == "formajoutpole") {
                            $this->ctrlHabilitation->formAjoutPole();
                        } else if ($_GET['action'] == 'ajout') {
                            $id = $this->getParametre($_POST, 'id');
                            $this->ctrlHabilitation->ajout($id);
                        } else if ($_GET['action'] == 'ajoutpole') {
                            $pole = $this->getParametre($_POST, 'pole');
                            $this->ctrlHabilitation->ajoutPole($pole);
                        } else if ($_GET['action'] == 'suppression') {
                            $id = $this->getParametre($_POST, 'id');
                            $this->ctrlHabilitation->suppression($id);
                        } else if ($_GET['action'] == 'visualisation') {
                            $this->ctrlHabilitation->visualisation();
                        } else {
                            throw new Exception("Action non valide.");
                        }
                    } else {
                        throw new Exception("Vous n'avez pas le droit d'accéder à cette page.");
                    }
                } else if ($_GET['categorie'] == "scolarite") {
                    if ($_SESSION['categorie'] == "scolarite") {
                        if ($_GET['action'] == 'formajout') {
                            $this->ctrlEtudiant->formAjout();
                        } else if ($_GET['action'] == 'formajoutliste') {
                            $this->ctrlEtudiant->formAjoutListe();
                        } else if ($_GET['action'] == 'formsuppression') {
                            $this->ctrlEtudiant->formSuppression();
                        } else if ($_GET['action'] == 'formattribution') {
                            $this->ctrlEtudiant->formAttribution();
                        } else if ($_GET['action'] == 'formattributionprogramme') {
                            $this->ctrlEtudiant->formAttributionProgramme();
                        } elseif ($_GET['action'] == 'vide') {
                            $this->ctrlEtudiant->vide();
                        } else if ($_GET['action'] == 'ajout') {
                            $prenom = $this->getParametre($_POST, 'prenom');
                            $nom = $this->getParametre($_POST, 'nom');
                            $programme = $this->getParametre($_POST, 'programme');
                            $semestre = $this->getParametre($_POST, 'semestre');
                            $this->ctrlEtudiant->ajout($prenom, $nom, $programme, $semestre);
                        } else if ($_GET['action'] == 'ajoutliste') {
                            $file = $_FILES["fichier"];
                            $this->ctrlEtudiant->ajoutListe($file);
                        } else if ($_GET['action'] == 'visualisation') {
                            $programme = $this->getParametre($_POST, 'programme');
                            $this->ctrlEtudiant->visualisationEtu($programme);
                        } else if ($_GET['action'] == 'formchoixprogramme') {
                            $this->ctrlEtudiant->choixProgramme();
                        } else if ($_GET['action'] == 'formchoixprogrammebis') {
                            $this->ctrlEtudiant->choixProgrammeBis();
                        } else if ($_GET['action'] == 'visualisationavecconseiller') {
                            $programme = $this->getParametre($_POST, 'programme');
                            $this->ctrlEnseignantChercheur->visualisationEtuAvecConseiller($programme);
                        } else if ($_GET['action'] == 'visualisationetusansconseiller') {
                            $this->ctrlEtudiant->visualisationEtuSansConseiller();
                        } else if ($_GET['action'] == 'visualisationconseiller') {
                            $this->ctrlEnseignantChercheur->visualisationDec();
                        } else if ($_GET['action'] == 'suppression') {
                            $id = $this->getParametre($_POST, 'id');
                            $this->ctrlEtudiant->suppression($id);
                        } else if ($_GET['action'] == 'attribution') {
                            $id = $this->getParametre($_POST, 'id');
                            $this->ctrlEtudiant->attribution($id);
                        } else if ($_GET['action'] == 'attributiontous') {
                            $this->ctrlEtudiant->attributionTous();
                        } else if ($_GET['action'] == 'attributionprogramme') {
                            $id = $this->getParametre($_POST, 'id');
                            $programme = $this->getParametre($_POST, 'programme');
                            $this->ctrlEtudiant->attributionProgramme($id, $programme);
                        } else {
                            throw new Exception("Action non valide.");
                        }
                    } else {
                        throw new Exception("Vous n'avez pas le droit d'accéder à cette page.");
                    }
                } else {
                    throw new Exception("Cette catégorie n'existe pas.");
                }
            } else {
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'utilisateur') {
                        $this->ctrlUtilisateur->utilisateur();
                    } else if ($_GET['action'] == 'connexion') {
                        $identifiant = $this->getParametre($_POST, 'identifiant');
                        $motDePasse = $this->getParametre($_POST, 'motDePasse');
                        $categorie = $this->getParametre($_POST, 'categorie');
                        $this->ctrlUtilisateur->connexion($identifiant, $motDePasse, $categorie);
                    } else if ($_GET['action'] == 'deconnexion') {
                        $this->ctrlUtilisateur->deconnexion();
                    } else {
                        $this->ctrlUtilisateur->accueil();
                    }
                } else {
                    $this->ctrlUtilisateur->accueil();
                }
            }
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    // Recherche si un paramètre est absent dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        } else {
            throw new Exception("Le paramètre '$nom' est manquant.");
        }
    }

    // Affichage des erreurs
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

}

?>