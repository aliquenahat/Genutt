<?php $this->titre = "Ajouter les habilitations par pôle"; ?>
<p><form class="form-inline well" action="index.php?categorie=responsable&action=ajoutpole" method="post"style="text-align:center;">
    <div class="form-group">
        <p><label>Pôle : </label> <select  class="form-control" name="pole">
                <option value="HETIC">HETIC</option>
                <option value="ROSAS">ROSAS</option>
                <option valude="P2MN">P2MN</option>
                <option valude="SUEL">SUEL</option>
            </select></p>
        <p><button type="submit" class="btn-block btn btn-default pull-right">Envoyer</button></p>
    </div>
</form>
</p>
