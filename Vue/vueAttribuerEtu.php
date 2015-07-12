<?php $this->titre = "Attribution effectuée"; ?>
<div class="hero-unit well">
    <h1>Attribution réussie</h1>
    <p>L'étudiant <?php echo ucfirst($etudiant['prenom_etu']) . " " . strtoupper($etudiant['nom_etu']); ?> a été attribué à 
        <?php echo ucfirst($etudiant['prenom_ec']) . " " . strtoupper($etudiant['nom_ec']); ?>. </p>
