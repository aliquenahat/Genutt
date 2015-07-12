<?php $this->titre = "Ajouter un étudiant"; ?>
<p><form class="form-inline well" action="index.php?categorie=scolarite&action=ajout" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label class="sr-only" for="prenom">Prénom</label><input id="prenom" name="prenom"type="text" class="form-control" placeholder="Prénom" required></p> 
        <p><label class="sr-only" for="nom">Nom</label><input id="nom" name="nom"type="text" class="form-control" placeholder="Nom" required></p> 
        <p><label>Programme : </label> <select  class="form-control" name="programme">
                <option value="ISI">ISI</option>
                <option value="MTE">MTE</option>
                <option value="TC">TC</option>
                <option value="SRT">SRT</option>
                <option value="SI">SI</option>
                <option value="SM">SM</option>
                <option value="PMOM">PMOM</option>
            </select></p> 
        <p><label>Semestre : </label> <select name="semestre">
                <?php
                for ($i = 1; $i < 9; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                }
                ?>  </select></p> 
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>
</p>
