<?php $this->titre = "Liste des étudiants avec leur conseiller par leur programme"; ?>
<form class="form-inline well" action="index.php?categorie=scolarite&action=visualisationavecconseiller" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label>Programme : </label> <select  class="form-control" name="programme">
                <option value="ISI">ISI</option>
                <option value="MTE">MTE</option>
                <option value="TC">TC</option>
                <option value="SRT">SRT</option>
                <option value="SI">SI</option>
                <option value="SM">SM</option>
                <option value="PMOM">PMOM</option>
            </select></p> 
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>