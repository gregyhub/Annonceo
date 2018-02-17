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
        /* ========================================================================
        affichage des Infos du Membre et du formulaire de modification des infos
        ===========================================================================*/
        ob_start();
        ?>
            <div class="jumbotron">
                <p>Bienvenue <span class="infoPseudo"><?= $_SESSION['membre']['pseudo'] ?></span></p>

                <ul class="list-group">
                    <form class="form-inline" id="formProfil">
                        <input type="hidden" class="idm" value="<?= $_SESSION['membre']['id_membre'] ?>">

                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="pseudo">Pseudo : </label>
                                <span class="infoMembre"><?= $_SESSION['membre']['pseudo'] ?></span> 
                                <button type="button" class="btn-xs btn btn-primary updateMembre">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <input type="text" name="pseudo" id="pseudo" class="form-control inputMembre" value="<?= $_SESSION['membre']['pseudo'] ?>">
                                <button type="button" class="btn-xs btn btn-primary savedMembre">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                </button>     
                            </div>        
                        </li>

                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="prenom">Prenom : </label>
                                <span class="infoMembre"><?= $_SESSION['membre']['prenom'] ?></span>
                                <button type="button" class="btn-xs btn btn-primary updateMembre">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <input type="text" name="prenom" id="prenom" class="inputMembre" value="<?= $_SESSION['membre']['prenom'] ?>">
                                <button type="button" class="btn-xs btn btn-primary savedMembre">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                </button>
                            </div>        
                        </li>


                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="nom">Nom : </label>
                                <span class="infoMembre"><?= $_SESSION['membre']['nom'] ?></span>
                                <button type="button" class="btn-xs btn btn-primary updateMembre">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <input type="text" name="nom" id="nom" class="inputMembre" value="<?= $_SESSION['membre']['nom'] ?>">
                                <button type="button" class="btn-xs btn btn-primary savedMembre">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                </button>
                            </div>        
                        </li>


                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="email">Email : </label>
                                <span class="infoMembre"><?= $_SESSION['membre']['email'] ?></span>
                                <button type="button" class="btn-xs btn btn-primary updateMembre">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <input type="text" name="email" id="email" class="inputMembre" value="<?= $_SESSION['membre']['email'] ?>">
                                <button type="button" class="btn-xs btn btn-primary savedMembre">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                </button>
                            </div>      
                        </li>


                        <li class="list-group-item">
                            <div class="form-group">
                                <label for="telephone">Téléphone : </label>
                                <span class="infoMembre"><?= $_SESSION['membre']['telephone'] ?></span>
                                <button type="button" class="btn-xs btn btn-primary updateMembre">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <input type="text" name="telephone" id="telephone" class="inputMembre" value="<?= $_SESSION['membre']['telephone'] ?>">
                                <button type="button" class="btn-xs btn btn-primary savedMembre">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                </button>
                            </div>    
                        </li>


                        <li class="list-group-item">
                            <div class="form-group">   
                                <label for="telephone">Civilité : </label>
                                <span class="infoMembre"><?= $_SESSION['membre']['civilite']=='m' ? 'Homme' : 'Femme' ?></span>
                                <button type="button" class="btn-xs btn btn-primary updateMembre">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                                <input type="radio" name="civilite" id="civilite" class="inputMembre" value="m"
                                    <?= $_SESSION['membre']['civilite']=='m' ? 'checked' : '' ?>><label class="labelRadio">Homme</label>
                                <input type="radio" name="civilite" id="civilite" class="inputMembre" value="f"
                                    <?= $_SESSION['membre']['civilite']=='f' ? 'checked' : '' ?>><label class="labelRadio">Femme</label>
                                <button type="button" class="btn-xs btn btn-primary savedMembre">
                                    <span class="glyphicon glyphicon-floppy-saved"></span>
                                </button>
                            </div>    
                        </li>
                    </form>
                </ul>

                <!-- afficher le prenom / Nom / mail / tel/ civilite /  -->
                <!-- + un afficher  formulaire le prenom / Nom / mail / tel/ civilite / mdp -->
            </div>
        <?php    
        $profil = ob_get_clean();

    } //fin du else -> estConnecté

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