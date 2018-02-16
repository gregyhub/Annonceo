<?php
    require_once('inc/init.php');

    if($_POST){
        $sql = "INSERT INTO membre values (NULL, :pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse, 0)";
           
        $insert = executeRequete($sql,  $listeChamps);
    }


$content .= '<div class="form-group <?= isset($errorInscription['prenom']) ? 'has-error' : '' ?>">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="saisissez votre prenom" value="<?= $_POST['prenom'] ?? '' ?>">
    <?= $errorInscription['prenom'] ?? '' ?>
</div>';


    include('inc/gabarit.php');

?>