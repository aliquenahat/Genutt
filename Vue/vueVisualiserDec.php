<?php $this->titre = "Liste des enseignant-chercheurs avec leurs nombre d'étudiants"; ?>
<table  class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Conseiller</th>
        <th>Nombre d'étudiants</th>
    </tr>
    <?php foreach ($enseignantChercheurs as $enseignantChercheur): ?>
        <tr>   

            <td><?php echo ucfirst($enseignantChercheur['prenom_ec']); ?> <?php echo strtoupper($enseignantChercheur['nom_ec']); ?></td>
            <td><?php echo $enseignantChercheur['nb']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>