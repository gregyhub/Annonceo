<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= RACINE_SITE.'inc/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?= RACINE_SITE.'inc/css/jquery-ui.css' ?>">
    <link rel="stylesheet" href="<?= RACINE_SITE.'inc/css/styles.css' ?>">
    <title>Site</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#monmenu">
                        <span class="sr-only">Nagiguer</span>
                        <span class="glyphicon gliphicon-menu-hamburger"></span>
                    </button>
                    <a href="<?= RACINE_SITE ?>" class="navbar-brand">Annonceo</a>
                </div>
                <div class="collapse navbar-collapse" id="monmenu">
                    <ul class="nav navbar-nav">
                        <?php

                            //le MENU en fonction de visiteur ou Admin
                            if( estConnecteEtAdmin() ){

                                
                                $menuGestion = '<li><a href="'.RACINE_SITE.'admin/gestion_annonces.php">Gestion des Annonces</a></li>';
                                $menuGestion .= '<li><a href="'.RACINE_SITE.'admin/gestion_membres.php">Gestion des Membres</a></li>';
                                $menuGestion .= '<li><a href="'.RACINE_SITE.'admin/gestion_categories.php">Gestion des Catégories</a></li>';
                                $menuGestion .= '<li><a href="'.RACINE_SITE.'admin/gestion_commentaires.php">Gestion des Commentaires</a></li>';

                                echo '<li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                  Gestion du site <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                  '.$menuGestion.'
                                </ul>
                              </li>';


                            }
                            if( estConnecte() ){
                                echo '<li><a href="'.RACINE_SITE.'profil.php">Profil</a></li>';
                                echo '<li><a href="'.RACINE_SITE.'deposer_annonce.php">déposer une annonce</a></li>';
                                echo '<li><a href="'.RACINE_SITE.'connexion.php?action=deconnexion">Se Déconnecter</a></li>';
                            }else{
                                echo '<li><a href="'.RACINE_SITE.'inscription.php">Inscription</a></li>';
                                echo '<li><a href="'.RACINE_SITE.'connexion.php">Connexion</a></li>';
                            }
                            
                        ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">


    <?= $content  ?>



    </div>
    <div class="container-fluid">
        <footer>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy;Copyright 2018 - GregyFringues - Tout droits réservés</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="<?= RACINE_SITE.'inc/js/jquery-3.3.1.min.js' ?>"></script>
    <script src="<?= RACINE_SITE.'inc/js/jquery-ui.js' ?>"></script>
    <script src="<?= RACINE_SITE.'inc/js/bootstrap.js' ?>"></script>
    <script src="<?= RACINE_SITE.'inc/js/monJS.js' ?>"></script>
</body>
</html>