<?php $this->titre = "Liste des enseignant-chercheurs dans la liste des conseillers"; ?>
<table  class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Bureau</th>
        <th>Pôle</th>
    </tr>
    <?php foreach ($enseignantChercheurs as $enseignantChercheur): ?>
        <tr>   
            <td><?php echo ucfirst($enseignantChercheur['prenom']); ?></td>
            <td><?php echo strtoupper($enseignantChercheur['nom']); ?></td>
            <td><?php echo strtoupper($enseignantChercheur['bureau']); ?></td>
            <td><?php echo strtoupper($enseignantChercheur['pole']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
