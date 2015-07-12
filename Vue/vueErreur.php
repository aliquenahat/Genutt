<?php $this->titre = "Erreur"; ?>
<div class="hero-unit well">
    <h2>Attention</h2>
    <p><?php echo $msgErreur; ?></p>
    <p>Redirection en cours...</p>
    <a class="btn btn-default btn-large" href="index.php">
        Accueil
    </a>
    <script type="text/javascript">
        window.setTimeout("location=('index.php');", 5000)
    </script>
</div>
