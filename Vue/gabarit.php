<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Gestion des conseillers de l'UTT">
        <meta name="keywords" content="Conseiller, UTT, LO07">
        <meta name="author" content="Ali Quenahat, Thibault Roy">
        <link rel="shortcut icon" href="Contenu/img/favicon.ico">
        <title>Genutt</title>
        <link href="Contenu/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <!-- Menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.php">Genutt</a>
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php">Accueil</a></li>
                            <?php echo $gestion; ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo $connexion; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <header class="page-header">
                <h1><?php echo $titre; ?></h1>
            </header>
            <div class="row">
                <section class="col-sm-12">
                    <?php echo $contenu; ?>
                </section>
            </div>
            <footer class="row">
                <div class="col-sm-12">
                    <p style="text-align:center;">
                        QUENAHAT Ali et ROY Thibault 2014 &copy; Tous droits réservés .:.
                        Valide : <a href='http://validator.w3.org/check?uri=referer'>HTML5</a> .:. 
                        Pour LO07</p>
                </div>
            </footer>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="Contenu/js/bootstrap.min.js"></script>
    </body>
</html>