<?php
    require_once('inc/init.php');

    if($_POST){

        //je fais les controles sur les champs 
        $controleChamps=champVide($_POST);
        $errorInscription = $controleChamps['champsvides'];

        if($errorInscription['nbError']==0) {
            //il n'y a pas de champs vide donc je continue de tester les champs

            //je controle que le pseudo soit disponible en AJAX -> monJS.js + ajax.php

            //vérifier qu'une chaine de caractère contient les caractères autorisé
             $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
            // $verif_cp = preg_match('#^[0-9]{5}$#', $_POST['cp']);
            /*
                # - delimite l'expression au début et à la fin
                ^ signifie commence par tout ce qui suit
                $ signifie finit par tout ce qui précède
                [] pour delimiter les intervals
                + pour dire que les caractères sont accepté de 0 à x fois.
            */

            $mdpCrypte = md5($_POST['mdp']);
            $controleChamps['champsvalides']['mdp'] = $mdpCrypte;
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                //email non valide
            }

            //pas d'erreur donc j'ajoute le membre dans la base
            $listeChamps =  $controleChamps['champsvalides'];
            $sql = "INSERT INTO membre values (NULL, :pseudo, :mdp, :nom, :prenom, :telephone,:email, :civilite, 0, CURDATE())";
           
            $insert = executeRequete($sql,$listeChamps);
            header("location:connexion.php?action=inscription");
            exit();
        }
        


   }

    ob_start();
	?>
	<form id="inscription" action="" method="post">
        <div class="form-group <?= isset($errorInscription['pseudo']) ? 'has-error' : '' ?>">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="saisissez votre pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
            <?= $errorInscription['pseudo'] ?? '' ?>
        </div>
        <div class="form-group <?= isset($errorInscription['prenom']) ? 'has-error' : '' ?>">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="saisissez votre prenom" value="<?= $_POST['prenom'] ?? '' ?>">
            <?= $errorInscription['prenom'] ?? '' ?>
        </div>
        <div class="form-group <?= isset($errorInscription['nom']) ? 'has-error' : '' ?>">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="saisissez votre nom" value="<?= $_POST['nom'] ?? '' ?>">
            <?= $errorInscription['nom'] ?? '' ?>
        </div>
        <!--email -->
        <div class="form-group <?= isset($errorInscription['email']) ? 'has-error' : '' ?>">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="saisissez votre email" value="<?= $_POST['email'] ?? '' ?>">
            <?= $errorInscription['email'] ?? '' ?>
        </div>
        <div class="form-group <?= isset($errorInscription['civilite']) ? 'has-error' : '' ?>">
        <!--Civilité -->
        <label>Civilité</label>
            <div class="radio">
                <label>
                    <input type="radio" name="civilite" id="femme" value="f" checked <?php if(!empty($_POST['civilite']) && $_POST['civilite'] == "f"){ echo 'checked';} else { echo '';} ?> />
                Femme
                </label>
                </div>
                <div class="radio">
                <label>
                    <input type="radio" name="civilite" id="homme" value="m" <?php if(!empty($_POST['civilite']) && $_POST['civilite'] == "m"){ echo 'checked';} else { echo '';} ?> />
                Homme
                </label>
                <?= $errorInscription['civilite'] ?? '' ?>
            </div>
        </div>
        <!--tel -->
        <div class="form-group <?= isset($errorInscription['telephone']) ? 'has-error' : '' ?>">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="saisissez votre telephone" value="<?= $_POST['telephone'] ?? '' ?>">
            <?= $errorInscription['telephone'] ?? '' ?>
        </div>
        
        <div class="form-group <?= isset($errorInscription['mdp']) ? 'has-error' : '' ?>">
            <label for="mdp">Password</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Password">
            <?= $errorInscription['mdp'] ?? '' ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Création du compte</button>
        <?=  $errorLog ?? '' ?>
    </form>
	<?php
	$content = ob_get_clean();

   

    include('inc/gabarit.php');

?>
