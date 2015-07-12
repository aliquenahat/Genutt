<?php $this->titre = "Liste des étudiants par leur programme"; ?>
<table  class="table table-striped table-bordered table-condensed table-hover">
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Programme</th>
    </tr>
    <?php foreach ($etudiants as $etudiant): ?>
        <tr>  

            <td><?php echo strtoupper($etudiant['prenom']); ?></td>
            <td><?php echo strtoupper($etudiant['nom']); ?></td>
            <td><?php echo strtoupper($etudiant['programme']); ?></td>            
        </tr>
    <?php endforeach; ?>
</table>