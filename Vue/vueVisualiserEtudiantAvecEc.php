<?php $this->titre = "Liste des etudiants avec leur enseignant chercheur"; ?>
<table  class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Etudiant</th>
        <th>Conseiller</th>
    </tr>
    <?php foreach ($enseignantChercheurs as $enseignantChercheur): ?>
        <tr>   

            <td><?php echo ucfirst($enseignantChercheur['prenom_etu']) . " " . strtoupper($enseignantChercheur['nom_etu']); ?></td>
            <td><?php echo ucfirst($enseignantChercheur['prenom_ec']) . " " . strtoupper($enseignantChercheur['nom_ec']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>