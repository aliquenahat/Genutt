<?php $this->titre = "Supprimer un enseignant-chercheur"; ?>
<form class="form-inline well" action="index.php?categorie=drh&action=suppression" method="post"style="text-align:center;">
    <div class="form-group"><p><label>Enseignant-chercheur : </label> <select  class="form-control" name="id">
                <?php foreach ($enseignantChercheurs as $enseignantChercheur): ?>
                    <option value="<?php echo $enseignantChercheur['id']; ?>"><?php
                        echo ucfirst($enseignantChercheur['prenom']) . " " . strtoupper($enseignantChercheur['nom']) . " - "
                        . "" . strtoupper($enseignantChercheur['bureau']) . " - " . strtoupper($enseignantChercheur['pole']);
                        ?>
                    <?php endforeach; ?>
            </select></p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>