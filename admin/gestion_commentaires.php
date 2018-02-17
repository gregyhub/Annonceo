<?php
    require_once('../inc/init.php');


    if(isset($_POST['valider']) && $_POST['valider'] == 'updateCommentaire' && estConnecteEtAdmin()){
        if(isset($_POST['id_commentaire'])){
            //je vérifie que l'id existe_POST
            $sql="SELECT * FROM commentaire WHERE id_commentaire=:id_commentaire";
            $commentairetAModifier = executeRequete($sql, array('id_commentaire' => $_POST['id_commentaire']));
            if($commentairetAModifier->rowCount()==0){
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-danger">Le commentaire que vous souhaitez modifier n'existe pas.</p>
                </div>
                <?php
                    $miseajourCommentaire = ob_get_clean();
            } elseif($commentairetAModifier->rowCount()==1){
                $commentairetAModifier = $commentairetAModifier->fetch(PDO::FETCH_ASSOC);
                //le produit existe dans la base, je le supprime
                $sql="UPDATE commentaire SET commentaire=:commentaire WHERE id_commentaire=:id_commentaire";
                executeRequete($sql, array('id_commentaire' => $_POST['id_commentaire'], 'commentaire' => $_POST['commentaire']));
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-success">Vous venez de modifier le commentaire N°<?= $commentairetAModifier['id_commentaire'] ?>  </p>
                </div>
                <?php
                $miseajourCommentaire = ob_get_clean();
            }

        }
    }

   //suppression d'un article
   if(isset($_GET['action']) && $_GET['action']=='supprimer' && estConnecteEtAdmin()){
       if(isset($_GET['id_commentaire'])){
        //je vérifie que l'id existe
            $sql="SELECT * FROM commentaire WHERE id_commentaire=:id_commentaire";
            $commentairetASupprimer = executeRequete($sql, array('id_commentaire' => $_GET['id_commentaire']));
            if($commentairetASupprimer->rowCount()==0){
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-danger">Le commentaire que vous souhaitez supprimer n'existe pas.</p>
                </div>
                <?php
                 $suppressionCommentaire = ob_get_clean();
            } elseif($commentairetASupprimer->rowCount()==1){
                $commentairetASupprimer = $commentairetASupprimer->fetch(PDO::FETCH_ASSOC);
                //le produit existe dans la base, je le supprime
                $sql="DELETE FROM commentaire WHERE id_commentaire=:id_commentaire";
                executeRequete($sql, array('id_commentaire' => $_GET['id_commentaire']));
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-success">Vous venez de supprimer le commentaire N°<?= $commentairetASupprimer['id_commentaire'] ?>  </p>
                </div>
                <?php
                $suppressionCommentaire = ob_get_clean();
            }
        }
        $_GET['id_commentaire']='';
        $_GET['action']='affichage';
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
        $erreurAutorisation = ob_get_clean();

    }else {
        //utilisateur connecté et admin

        ob_start();
        //affichage des commentaires -> action par défaut.
        $sql = "SELECT id_commentaire, CONCAT(id_membre, ' - ', pseudo) as membre, CONCAT(id_annonce, ' -   ', titre) as annonce, commentaire, DATE_FORMAT(c.date_enregistrement, '%d/%m/%Y') as 'date d\'enregistrement'
            FROM commentaire c, membre m, annonce a WHERE m.id_membre=c.membre_id AND a.id_annonce=c.annonce_id";
        $commentaires = executeRequete($sql);

        if($commentaires->rowCount() == 0){
            //si aucun article dans la base
            ?>
                <div class="jumbotron">
                    <p>il n'y a aucun commentaire a afficher sur votre site.</p>    
                </div>
            <?php
        }
        else{
            //si il y a des commentaire, je les affiche ici
            //je vais afficher un tableau avec comme entete le nom des champs.
            ?>
            <table class="table  table-striped table-hover">
                <tr>
                <?php
                    //je génère les entete de colonnes
                    $nbColonnes = $commentaires->columnCount();
                    for($i=0; $i<$nbColonnes; $i++){
                        $infosColonne = $commentaires->getColumnMeta($i);
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
                while($commentaire = $commentaires->fetch(PDO::FETCH_ASSOC)){
                    $idCommentaire= $commentaire['id_commentaire'];
                    ?>
                    <tr>
                    <?php
                    foreach($commentaire as $champ => $infoCommentaire){
                        
                        ?>
                        <td class="text-center <?= $champ=='commentaire' ? 'msgCommentaire' : ''  ?>"><?= $infoCommentaire ?></td>
                        <?php
                        //
                    }
                    ?>
                        <td class="text-center">
                            <button type="button" title="modifiez le commentaire" id="<?= $idCommentaire ?>" class="btn-xs btn btn-primary updateCommentaire" data-toggle="modal" data-target="#formModifCommentaire"><span class="glyphicon glyphicon-pencil"></span></button>
                            
                            <a href="?action=supprimer&id_commentaire=<?= $idCommentaire ?>" title="supprimer le commentaire"><span class="glyphicon glyphicon-remove"></span></a>
                            
                        </td>
                    </tr>
                    <?php
                }
            ?>
            </table>

            <?php
        }
        
        $affichageCommentaires = ob_get_clean();


        //affichage de formulaire de modification
        ob_start();
        ?>
        <div id="formModifCommentaire" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modifiez le commentaire</h4>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                                <textarea class="form-control getCommentaire" rows="3" name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                                <input type="hidden" id="inputIdCommentaire" name="id_commentaire" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="valider" value="updateCommentaire" class="btn btn-primary">
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php
        $modal=ob_get_clean();


    } //fin du else connecté

    ob_start();
    ?>
        <h1 class="text-center">Vous etes sur la gestion des Commentaires</h1>
        <?= $erreurAutorisation ?? '' ?>
        <?= $miseajourCommentaire ?? '' ?>
        <?= $suppressionCommentaire ?? '' ?>
        <?= $affichageCommentaires ?? '' ?>
        <?= $modal ?? '' ?>
   <?php
    $content = ob_get_clean();

    include('../inc/gabarit.php');

?>
