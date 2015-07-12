<?php $this->titre = "Tâche réussie"; ?>
<div class="hero-unit well">
    <h2>Bravo</h2>
    <p><?php echo $msgOk; ?></p>
    <p>Redirection en cours...</p>
    <a class="btn btn-default btn-large" href="index.php">
        Accueil
    </a>
    <script type="text/javascript">
        window.setTimeout("location=('index.php');", 5000)
    </script>
</div>
