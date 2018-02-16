<?php
    require_once('inc/init.php');

    if( !estConnecte()){
        ob_start();
        ?>
            <div class="jumbotron">
                <p>vous n'avez pas l'autorisation d'être sur cette Page.<br>Authentifiez vous ou créez un compte.</p>
                <a href="connexion.php">Pour vous connecter ou créer un compte</a><br>
                <a href="index.php">Pour vous retourner à l'accueil</a>
            </div>
            
        <?php
        $profil = ob_get_clean();

    }else {
        //affichage des Infos du Membre
        ob_start();
        ?>
            <div class="jumbotron">
                <p>Bievenu <?= $_SESSION['membre']['pseudo'] ?></p>

                <ul class="list-group">
                    <input type="hidden" class="idm" value="<?= $_SESSION['membre']['id_membre'] ?>">

                    <li class="list-group-item">
                        Pseudo : <span class="infoMembre"><?= $_SESSION['membre']['pseudo'] ?></span> 
                        <button type="button" class="btn btn-primary updateMembre">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                        <input type="text" name="pseudo" id="pseudo" class="inputMembre" value="<?= $_SESSION['membre']['pseudo'] ?>">
                        <button type="button" class="btn btn-primary savedMembre">
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                        </button>                        
                    </li>




                    <li class="list-group-item">Prenom : <span class="infoMembre"><?= $_SESSION['membre']['prenom'] ?></span>
                         <button type="button" class="btn btn-primary updateMembre"><span class="glyphicon glyphicon-pencil"></span></button>
                        <input type="text" name="prenom" id="prenom" class="inputMembre" value="<?= $_SESSION['membre']['prenom'] ?>">
                        <button type="button" class="btn btn-primary savedMembre">
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                        </button>
                    </li>


                    <li class="list-group-item">Nom : <span class="infoMembre"><?= $_SESSION['membre']['nom'] ?></span> <button type="button" class="btn btn-primary updateMembre"><span class="glyphicon glyphicon-pencil"></span></button>
                        <input type="text" name="nom" id="nom" class="inputMembre" value="<?= $_SESSION['membre']['nom'] ?>">
                        <button type="button" class="btn btn-primary savedMembre">
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                        </button>
                    </li>


                    <li class="list-group-item">Email : <span class="infoMembre"><?= $_SESSION['membre']['email'] ?></span>
                     <button type="button" class="btn btn-primary updateMembre"><span class="glyphicon glyphicon-pencil"></span></button>
                        <input type="text" name="email" id="email" class="inputMembre" value="<?= $_SESSION['membre']['email'] ?>">
                        <button type="button" class="btn btn-primary savedMembre">
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                        </button>
                    </li>


                    <li class="list-group-item">Téléphone : <span class="infoMembre"><?= $_SESSION['membre']['telephone'] ?></span>
                     <button type="button" class="btn btn-primary updateMembre"><span class="glyphicon glyphicon-pencil"></span></button>
                        <input type="text" name="telephone" id="telephone" class="inputMembre" value="<?= $_SESSION['membre']['telephone'] ?>">
                        <button type="button" class="btn btn-primary savedMembre">
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                        </button>
                    </li>


                    <li class="list-group-item">Civilite : <span class="infoMembre"><?= $_SESSION['membre']['civilite'] ?>
                    </span> <button type="button" class="btn btn-primary updateMembre"><span class="glyphicon glyphicon-pencil"></span></button>
                        <input type="radio" name="civilite" id="civilite" class="inputMembre" value="m">Homme
                        <input type="radio" name="civilite" id="civilite" class="inputMembre" value="f">Femme
                        <button type="button" class="btn btn-primary savedMembre">
                            <span class="glyphicon glyphicon-floppy-saved"></span>
                        </button>
                    </li>
                </ul>

                <!-- afficher le prenom / Nom / mail / tel/ civilite /  -->
                <!-- + un afficher  formulaire le prenom / Nom / mail / tel/ civilite / mdp -->
            </div>
        <?php    
        $profil = ob_get_clean();
    }

    ob_start();
	?>
    <div class="row">
        <div class="col-md-6">
             <?= $profil ?? '' ?> 
        </div>
        <div class="col-md-6">
            <?= $commandes ?? '' ?> 
        </div>
        
    </div>
    <?php
    $content = ob_get_clean();



    include('inc/gabarit.php');

?>