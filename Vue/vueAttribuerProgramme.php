<?php $this->titre = "Attribuer un nouveau conseiller à un étudiant du TC pour son transfert"; ?>
<form class="form-inline well" action="index.php?categorie=scolarite&action=attributionprogramme" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label>Etudiant : </label> <select  class="form-control" name="id">
                <?php foreach ($etudiants as $etudiant): ?>
                    <option value="<?php echo $etudiant['numero']; ?>"><?php
                        echo ucfirst($etudiant['prenom']) . " " . strtoupper($etudiant['nom']) . " "
                        . "" . strtoupper($etudiant['programme']) . "" . $etudiant['semestre'];
                        ?>
                    <?php endforeach; ?>
            </select>
        </p>
        <p><label>Programme : </label> <select  class="form-control" name="programme">
                <option value="ISI">ISI</option>
                <option value="MTE">MTE</option>
                <option value="SRT">SRT</option>
                <option value="SI">SI</option>
                <option value="SM">SM</option>
                <option value="PMOM">PMOM</option>
            </select></p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>