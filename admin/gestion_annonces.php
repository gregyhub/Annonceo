<?php
require_once('../inc/init.php');


 //suppression d'une categorie

 if(isset($_GET['action']) && $_GET['action']=='supprimer' && estConnecteEtAdmin())
 {
    if(isset($_GET['id_annonce']))
    {
     //je vérifie que l'id existe
         $sql="SELECT * FROM annonce WHERE id_annonce=:id_annonce";
         $annonceASupprimer = executeRequete($sql, array('id_annonce' => $_GET['id_annonce']));
         if($annonceASupprimer->rowCount()==0)
         {
             ob_start();
             ?>
             <div class="jumbotron">
                 <p class="alert alert-danger">L'annonce que vous souhaitez supprimer n'existe pas.</p>
             </div>
             <?php
              $suppressionannonce = ob_get_clean();
         } elseif($annonceASupprimer->rowCount()==1)
         {
             $annonceASupprimer = $annonceASupprimer->fetch(PDO::FETCH_ASSOC);
             //la categ existe dans la base, je la supprime
             $sql="DELETE FROM annonce WHERE id_annonce=:id_annonce";
             executeRequete($sql, array('id_annonce' => $_GET['id_annonce']));
             ob_start();
             ?>
             <div class="jumbotron">
                 <p class="alert alert-success">Vous venez de supprimer l'annonce N°<?= $annonceASupprimer['id_annonce'] ?>  </p>
             </div>
             <?php
             $suppressionannonce = ob_get_clean();
         }
     }
     $_GET['id_annonce']='';
}
if( !estConnecteEtAdmin())
    {
        //vérification des autorisation ! Il faut etre admin pour afficher la page
        ob_start();
        ?>
            <div class="jumbotron">
                <p>vous n'avez pas l'autorisation d'être sur cette Page.<br>Authentifiez vous.</p>
                <a href="../connexion.php">Pour vous connecter</a><br>
                <a href="../index.php">Pour vous retourner à l'accueil</a>
            </div>
            
        <?php
        $erreurAutorisation = ob_get_clean();

    } 
else 
    {
        //utilisateur connecté et admin

        ob_start();
        //affichage des categories -> action par défaut.
        $sql = "SELECT * from annonce";
        $annonces = executeRequete($sql);

        if($annonces->rowCount() == 0)
        {
            //si aucun article dans la base
            ?>
                <div class="jumbotron">
                    <p>il n'y a aucune annonce à afficher sur votre site.</p>    
                </div>
            <?php
        }
        else
        {
                //si il y a des categorie, je les affiche ici
                //je vais afficher un tableau avec comme entete le nom des champs.
                ?>


                <table class="table  table-striped table-hover">
                    <tr>
                        <?php

                //je génère les entete de colonnes
                        $nbColonnes = $annonces->columnCount();
                        for($i=0; $i<$nbColonnes; $i++)
                            {
                                $infosColonne = $annonces->getColumnMeta($i);
                                //donne dans un tableau les infos pour une colonne pour chaque index de  0 à N.
                                //ce tableau, à l'index 'name' donne le nom du champs.
                        ?>
                        <th class="text-center"><?= $infosColonne['name'] ?></th>
                        <?php
                            }
                        ?>
                        <th class="text-center">Actions</th>

                    </tr> <!-- fin de ligne d'entete -->
                        <?php
                            while($annonce = $annonces->fetch(PDO::FETCH_ASSOC))
                            {
                                $idannonce= $annonce['id_annonce'];
                            ?>
                            <tr>
                            <?php
                                foreach($annonce as $champ => $infoAnnonce)
                                {            
                                    if($champ=='photo') {
                                     ?>
                                         <td class="text-center"><img class="photoAdmin" src="../inc/photos/<?=  $infoAnnonce ?>"></td>
                                    <?php
                                    }else{          
                                    ?>
                                    <td class="text-center"><?=  $infoAnnonce ?></td>
                                 <?php
                                    }
                                }
                            ?>

                            <td class="text-center">
                                <button type="button" title="modifiez la categorie" id="<?= $idannonce ?>" class="btn-xs btn btn-primary updateAnnonce" data-toggle="modal" data-target="#formModifAnnonce"><span class="glyphicon glyphicon-pencil"></span></button>
                                                
                                <a href="?action=supprimer&id_annonce=<?= $idannonce ?>" title="supprimer la l'annonce"><span class="glyphicon glyphicon-remove"></span></a>
                                                
                            </td>
                        </tr>                       
                            <?php } ?>
                </table>
                <?php
        }
    }

$content=ob_get_clean();

require_once('../inc/gabarit.php');
