<?php
    require_once('../inc/init.php');

   //suppression d'un article
   if(isset($_GET['action']) && $_GET['action']=='supprimer' && estConnecteEtAdmin()){
      
   }

    //formulaire Ajout/modification d'un produit
    if($_POST && estConnecteEtAdmin()){
        
        
    }


    if( !estConnecteEtAdmin()){
        //vérification des autorisation ! Il faut etre admin pour afficher la page
        ob_start();
        ?>
            <div class="jumbotron">
                <p>vous n'avez pas l'autorisation d'être sur cette Page.<br>Authentifiez vous.</p>
                <a href="../connexion.php">Pour vous connecter</a><br>
                <a href="../index.php">Pour vous retourner à l'accueil</a>
            </div>
            
        <?php
        $content = ob_get_clean();

    }else {
        ob_start();
        ?>
            <div class="jumbotron">
                <p>Gestion des membres</p>
            </div>
            
        <?php
        $content = ob_get_clean();
    }

   

    include('../inc/gabarit.php');

?>
