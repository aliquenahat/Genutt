<?php $this->titre = "Liste des enseignant-chercheurs avec leurs étudiants"; ?>
<table  class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Conseiller</th>
        <th>Etudiant</th>
    </tr>
    <?php foreach ($enseignantChercheurs as $enseignantChercheur): ?>
        <tr>   

            <td><?php echo ucfirst($enseignantChercheur['prenom_ec']) . " " . strtoupper($enseignantChercheur['nom_ec']); ?></td>
            <td><?php echo ucfirst($enseignantChercheur['prenom_etu']) . " " . strtoupper($enseignantChercheur['nom_etu']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>