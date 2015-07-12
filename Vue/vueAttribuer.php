<?php $this->titre = "Attribuer un conseiller à un étudiant"; ?>
<form class="form-inline well" action="index.php?categorie=scolarite&action=attribution" method="post"style="text-align:center;">
    <div class="form-group"><p><label>Etudiant : </label> <select  class="form-control" name="id">
                <?php foreach ($etudiants as $etudiant): ?>
                    <option value="<?php echo $etudiant['numero']; ?>"><?php
                        echo ucfirst($etudiant['prenom']) . " " . strtoupper($etudiant['nom']) . " "
                        . "" . strtoupper($etudiant['programme']) . "" . $etudiant['semestre'];
                        ?>
                    <?php endforeach; ?>
            </select> </p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>
