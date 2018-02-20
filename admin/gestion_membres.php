<?php

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); /* si pas admin, redirection vers la page connexion */
}





//suppression membre 

if(isset($_GET['action']) && $_GET['action']=='supprimer' && estConnecteEtAdmin())
{
    if(isset($_GET['id_categorie']))

    {
     /*je vérifie que l'id existe
         $sql="SELECT * FROM membre WHERE id_membre=:id_membre";
         $membreASupprimer = executeRequete($sql, array('id_membre' => $_GET['id_membre']));
         if($membreASupprimer->rowCount()==0){
             ob_start();
             ?>
             <div class="jumbotron">
                 <p class="alert alert-danger">La categorie que vous souhaitez supprimer n'existe pas.</p>
             </div>
             <?php
              $suppressioncategorie = ob_get_clean();
    } */

            // $membreASupprimer = $membreASupprimer->fetch(PDO::FETCH_ASSOC);
             //la categ existe dans la base, je le supprime
            $sql="DELETE FROM membre WHERE id_membre=:id_membre";
            executeRequete($sql, array('id_membre' => $_GET['id_membre']));
            ob_start();
            ?>
            <div class="jumbotron">
                <p class="alert alert-success">Vous venez de supprimer le membre N°<?= $membreASupprimer['id_categorie'] ?>  </p>
            </div>
            <?php
            $suppressionmembre = ob_get_clean();
         
     }
     $_GET['id_membre']='';
     $_GET['action']='supprimer'; 
}




/* creer un tableau html qui liste tout les membres ( sauf le mot de passe ) */

$sql = executeRequete("SELECT * FROM membre");
$content='';
$content .="<h3>Affichage des membres</h3>";
$content .="<p>Nombre de membres : ".$sql->rowCount()."</p>";
$content .="<table class=' table table-striped table-hover'>
                <tr>";
// les en tetes 
for( $i=0; $i<$sql->columnCount() ; $i++)        
{
    $colonne = $sql->getColumnMeta($i);
    if ( $colonne['name'] !='mdp')
    {
        $content .='<th>'.ucfirst($colonne['name']).'</th>';
    }
} 
$content .='<th colspan="4">Actions</th>';
$content .="</tr>";
/* les donnees */
while ( $ligne = $sql->fetch(PDO::FETCH_ASSOC) )
{
    $content .='<tr>';
    foreach($ligne as $indice =>$information)
    {
        if ( $indice !='mdp'){
            $content .="<td class='text-center'>".$information.'</td>';
        }
    }
    if ( $ligne['id_membre'] != $_SESSION['membre']['id_membre'])
    {
    
    
    $content .='<td><a href="?action=supprimer&id_membre='.$ligne['id_membre'].'"onclick=
    "return(confirm(\'Etes vous certain de vouloir supprimer ce membre :'.$ligne['nom'].'?\'))">Supprimer</a></td>';
    }
    $content .='</tr>';
}
$content .='<table>';

ob_start();
?>
<form id="inscription" action="" method="post">
    <!------------------------------------------ Pseudo ------------------------------------>
        <div class="form-group <?= isset($errorInscription['pseudo']) ? 'has-error' : '' ?>">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="saisissez votre pseudo" value="<?= $_POST['pseudo'] ?? '' ?>">
            <?= $errorInscription['pseudo'] ?? '' ?>
        </div>
        <!-------------------------------------   Prénom ---------------------------------->
        <div class="form-group <?= isset($errorInscription['prenom']) ? 'has-error' : '' ?>">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="saisissez votre prenom" value="<?= $_POST['prenom'] ?? '' ?>">
            <?= $errorInscription['prenom'] ?? '' ?>
        </div>
        <!------------------------------------     Nom     ---------------------------------------->
        <div class="form-group <?= isset($errorInscription['nom']) ? 'has-error' : '' ?>">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="saisissez votre nom" value="<?= $_POST['nom'] ?? '' ?>">
            <?= $errorInscription['nom'] ?? '' ?>
        </div>
        <!-- -----------------------------------  email ---------------------------------------->

        <div class="form-group <?= isset($errorInscription['email']) ? 'has-error' : '' ?>">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="saisissez votre email" value="<?= $_POST['email'] ?? '' ?>">
            <?= $errorInscription['email'] ?? '' ?>
        </div>
        <div class="form-group <?= isset($errorInscription['civilite']) ? 'has-error' : '' ?>">
        <!-----------------------------------   Civilité  ---------------------------------------->
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
        <!-------------------------------------Telephone ---------------------------------------->

        <div class="form-group <?= isset($errorInscription['telephone']) ? 'has-error' : '' ?>">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="saisissez votre telephone" value="<?= $_POST['telephone'] ?? '' ?>">
            <?= $errorInscription['telephone'] ?? '' ?>
        </div>
        <!------------------------------------- Password ---------------------------------------->
        <div class="form-group <?= isset($errorInscription['mdp']) ? 'has-error' : '' ?>">
            <label for="mdp">Password</label>
            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Password">
            <?= $errorInscription['mdp'] ?? '' ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Création du compte</button>
        <?=  $errorLog ?? '' ?>
    </form>
<?php
$formulairemembre=ob_get_clean();

ob_start();
?>

<div>
    <?= $content ?>
   </div> <div>
    <?= $formulairemembre ?>
</div>
<?= $suppressionmembre ?? '' ?>

<?php
$content=ob_get_clean();


require_once('../inc/gabarit.php');
