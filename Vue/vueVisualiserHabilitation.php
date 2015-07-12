<?php $this->titre = "Liste des étudiants avec leurs conseillers"; ?>
<table  class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Etudiant</th>
        <th>Conseiller</th>
    </tr>
    <?php foreach ($habilitations as $habilitation): ?>
        <tr>   
            <td><?php echo ucfirst($habilitation['prenom_etu']) . " " . strtoupper($habilitation['nom_etu']); ?></td>
            <td><?php echo ucfirst($habilitation['prenom_ec']) . " " . strtoupper($habilitation['nom_ec']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>