<?php $this->titre = "Ajouter une liste d'enseignant-chercheur"; ?>
<form class="form-inline well"enctype='multipart/form-data' action="index.php?categorie=drh&action=ajoutliste" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label for="fichier">Fichier :</label> <input id="fichier" name="fichier" type="file" class="form-control" ></p> 
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>
