<?php

session_start();

class Vue {

    private $fichier;
    private $titre;

    public function __construct($action) {
        $this->fichier = "Vue/vue" . $action . ".php";
    }

    //Return un code html selon l'authentification de l'utilisateur
    public function isConnect() {
        //Si il est connecté on affiche son nom et le lien pour la déconnexion
        if (isset($_SESSION['identifiant'])) {
            " ";
            $cat = "";
            if ($_SESSION['categorie'] == 'drh') {
                $cat = "Direction des hessources humaines";
            } else if ($_SESSION['categorie'] == 'responsable') {
                $cat = "Responsable de programme";
            } else if ($_SESSION['categorie'] == 'scolarite') {
                $cat = "Service scolarité";
            }
            return "<li><a href='index.php?action=accueil'>" . $_SESSION['identifiant'] . " (" . $cat . ""
                    . ")</a></li><li><a href='index.php?action=deconnexion'>Déconnexion</a></li>";
        } else {
            return "<li><a href='index.php?action=utilisateur'>Connexion</a></li>";
        }
    }

    //Affichage du code html pour les liens du menu gestion selon la catégorie de l'utilisateur
    public function gestion() {
        if (isset($_SESSION['categorie'])) {
            if ($_SESSION['categorie'] == 'drh') {
                return '   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestion des EC<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li class="dropdown-header">Traitement</li>
                                    <li><a href="index.php?categorie=drh&action=formajout">Ajouter</a></li>
                                    <li><a href="index.php?categorie=drh&action=formajoutliste">Ajouter une liste</a></li>
                                    <li><a href="index.php?categorie=drh&action=vide">Vider</a></li>
                                    <li><a href="index.php?categorie=drh&action=formsuppression">Supprimer</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Visualisation</li>
                                    <li><a href="index.php?categorie=drh&action=visualisation">Liste des EC dans la liste des conseillers</a></li>
                                    <li><a href="index.php?categorie=drh&action=visualisationetu">Liste des EC avec les étudiants</a></li>
                                    <li><a href="index.php?categorie=drh&action=visualisationdec">Liste des EC avec leurs nombre d\'étudiants</a></li>
                                </ul>
                            </li>';
            } else if ($_SESSION['categorie'] == 'responsable') {
                return '   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestion des habilitations<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li class="dropdown-header">Traitement</li>
                                    <li><a href="index.php?categorie=responsable&action=formajout">Ajouter</a></li>
                                    <li><a href="index.php?categorie=responsable&action=formajoutpole">Ajouter par pôle</a></li>
                                    <li><a href="index.php?categorie=responsable&action=formsuppression">Supprimer</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Visualisation</li>
                                    <li><a href="index.php?categorie=responsable&action=visualisation">Liste des étudiants avec leurs conseillers</a></li>
                                </ul>
                            </li>';
            } else if ($_SESSION['categorie'] == 'scolarite') {
                return '   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestion de la scolarité<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                <li class="dropdown-header">Etudiant</li>
                                    <li><a href="index.php?categorie=scolarite&action=formajout">Ajouter</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=formajoutliste">Ajouter une liste</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=formsuppression">Supprimer</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=vide">Vider</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Visualisation</li>
                                    <li><a href="index.php?categorie=scolarite&action=formchoixprogramme">Liste des étudiants par programme</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=visualisationetusansconseiller">Liste des étudiants sans conseillers</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=formchoixprogrammebis">Liste des étudiants avec leurs conseillers</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=visualisationconseiller">Liste des conseillers</a></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Attribution</li>
                                    <li><a href="index.php?categorie=scolarite&action=formattribution">Attribuer un conseiller à un étudiant</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=attributiontous">Attribuer un conseiller à tous</a></li>
                                    <li><a href="index.php?categorie=scolarite&action=formattributionprogramme">Changement de programme TC</a></li>
                                </ul>
                            </li>';
            } else {
                return "";
            }
        }
    }

    //Affichage d'une page qui ne reçoit pas de paramètre
    public function afficher() {
        $contenu = $this->genererFichier($this->fichier);
        $vue = $this->genererFichier('Vue/gabarit.php', array('gestion' => $this->gestion(), 'connexion' => $this->isConnect(), 'titre' => $this->titre, 'contenu' => $contenu));
        echo $vue;
    }

    //Affichage d'une page recevoit des paramètres
    public function generer($donnees) {
        $contenu = $this->genererFichier($this->fichier, $donnees);
        $vue = $this->genererFichier('Vue/gabarit.php', array('gestion' => $this->gestion(), 'connexion' => $this->isConnect(), 'titre' => $this->titre, 'contenu' => $contenu));
        echo $vue;
    }

    private function genererFichier($fichier, $donnees = "") {
        if (file_exists($fichier)) {
            if (!empty($donnees)) {
                extract($donnees);
            }
            ob_start();
            require $fichier;
            return ob_get_clean();
        } else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }

}

?>