<?php $this->titre = "Ajouter un enseignant-chercheur"; ?>
<form class="form-inline well" action="index.php?categorie=drh&action=ajout" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label class="sr-only" for="prenom">Prénom</label><input id="prenom" name="prenom"type="text" class="form-control" placeholder="Prenom" required></p> 
        <p><label class="sr-only" for="nom">Nom</label><input id="nom" name="nom"type="text" class="form-control" placeholder="Nom" required></p> 
        <p><label class="sr-only" for="bureau">Bureau</label><input id="bureau" name="bureau"type="text" class="form-control" placeholder="Bureau" required></p> 
        <p><label>Pôle : </label> <select  class="form-control" name="pole">
                <option value="HETIC">HETIC</option>
                <option value="ROSAS">ROSAS</option>
                <option valude="P2MN">P2MN</option>
                <option valude="SUEL">SUEL</option>
            </select></p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>