<?php $this->titre = "Ajouter une habilitation"; ?>
<form class="form-inline well" action="index.php?categorie=responsable&action=ajout" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label>Enseignant-chercheur : </label> <select class="form-control" name="id">
                <?php foreach ($enseignantChercheurs as $enseignantChercheur): ?>
                    <option value="<?php echo $enseignantChercheur['id']; ?>"><?php
                        echo ucfirst($enseignantChercheur['prenom']) . " " . strtoupper($enseignantChercheur['nom']);
                        ?>
                    <?php endforeach; ?>
            </select></p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>