<?php $this->titre = "Connexion"; ?>
<form class="form-inline well" action="index.php?action=connexion" method="post" style="text-align:center;">
    <div class="form-group">
        <p> <label class="sr-only" for="identifiant">Saisie identifiant</label><input id="identifiant" name="identifiant" type="text" class="form-control" placeholder="Identifiant" required></p> 
        <p><label class="sr-only" for="motDePasse">Saisie mot de passe</label><input id="motDePasse" name="motDePasse" type="password" class="form-control" placeholder="Mot de passe" required></p>
        <p><label for="motDePasse">Catégorie : </label> <select class="form-control" name="categorie">
                <option value="drh">Direction des ressources humaines</option>
                <option value="responsable">Responsable de programme</option>
                <option value="scolarite">Service scolarité</option>
            </select></p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>