<?php
    require_once('../inc/init.php');


    if(isset($_POST['valider']) && $_POST['valider'] == 'updateCategorie' && estConnecteEtAdmin())
    {

        if(empty($_POST['id_categorie'])){
            //ajout d'une categorie
            

            $sql="SELECT titre FROM categorie WHERE titre=:titre";
            $ajoutCateg = executeRequete($sql,array('titre' => $_POST['titre']));

            if($ajoutCateg->rowCount()==1){
                //le titre existe deja
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-danger">la categorie que vous souhaitez ajouter existe déja.</p>
                </div>
                <?php

                    $ajoutcateg = ob_get_clean();
                }
                else{
                    //sinon rowCOunt = 0 DONC LE TITRE EST DISPO? JE FAIS L AJOUT EN BDD
                    $sql = 'INSERT INTO categorie VALUES(NULL, :titre, :motscles)';
                    executeRequete($sql,array(
                        'titre'    => $_POST['titre'],
                        'motscles' => $_POST['motscles'])
                    );
                    ob_start();
                    ?>
                    <div class="jumbotron">
                        <p class="alert alert-success">la categorie <?= $_POST['titre'] ?> a bien été ajoutée avec succes.</p>
                    </div>
                    <?php
        
                        $ajoutcateg = ob_get_clean();
                }
        }
        elseif(isset($_POST['id_categorie'])){
            //je vérifie que l'id existe_POST
            $sql="SELECT * FROM categorie WHERE id_categorie=:id_categorie";

            $categorietAModifier = executeRequete($sql, array('id_categorie' => $_POST['id_categorie']));
            if($categorietAModifier->rowCount()==0){
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-danger">la categorie que vous souhaitez modifier n'existe pas.</p>
                </div>
                <?php

                    $miseajourcategorie = ob_get_clean();
            } elseif
            ($categorietAModifier->rowCount()==1){
                $categorietAModifier = $categorietAModifier->fetch(PDO::FETCH_ASSOC);
                //le produit existe dans la base, je le supprime
                $sql="UPDATE categorie SET titre=:titre, motscles=:motscles WHERE id_categorie=:id_categorie";
                
                executeRequete($sql,array(
                                            'id_categorie' => $_POST['id_categorie'], 
                                            'titre' => $_POST['titre'],
                                            'motscles' => $_POST['motscles'])
                                        );
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-success">Vous venez de modifier la categorie N°<?= $categorieAModifier['id_categorie'] ?>  </p>
                </div>
                <?php
                $miseajourcategorie = ob_get_clean();
            }

        }
    }

   //suppression d'une categorie

    if(isset($_GET['action']) && $_GET['action']=='supprimer' && estConnecteEtAdmin())
    {
       if(isset($_GET['id_categorie'])){
        //je vérifie que l'id existe
            $sql="SELECT * FROM categorie WHERE id_categorie=:id_categorie";
            $categorietASupprimer = executeRequete($sql, array('id_categorie' => $_GET['id_categorie']));
            if($categorietASupprimer->rowCount()==0){
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-danger">La categorie que vous souhaitez supprimer n'existe pas.</p>
                </div>
                <?php
                 $suppressioncategorie = ob_get_clean();
            } elseif($categorietASupprimer->rowCount()==1)
            {
                $categorietASupprimer = $categorietASupprimer->fetch(PDO::FETCH_ASSOC);
                //la categ existe dans la base, je la supprime
                $sql="DELETE FROM categorie WHERE id_categorie=:id_categorie";
                executeRequete($sql, array('id_categorie' => $_GET['id_categorie']));
                ob_start();
                ?>
                <div class="jumbotron">
                    <p class="alert alert-success">Vous venez de supprimer la categorie N°<?= $categorietASupprimer['id_categorie'] ?>  </p>
                </div>
                <?php
                $suppressioncategorie = ob_get_clean();
            }
        }
        $_GET['id_categorie']='';
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
            $sql = "SELECT * from categorie";
            $categories = executeRequete($sql);

        if($categories->rowCount() == 0)
            {
                //si aucun article dans la base
                ?>
                    <div class="jumbotron">
                        <p>il n'y a aucune categorie a afficher sur votre site.</p>    
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
                            $nbColonnes = $categories->columnCount();
                            for($i=0; $i<$nbColonnes; $i++)
                            {
                                $infosColonne = $categories->getColumnMeta($i);
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
                    while($categorie = $categories->fetch(PDO::FETCH_ASSOC))
                        {
                            $idcategorie= $categorie['id_categorie'];
                            ?>
                            <tr>
                            <?php
                            foreach($categorie as $champ => $infocategorie)
                                {                        
                                    ?>
                                    <td class="text-center <?= $champ=='titre' ? 'categtitre' : ''  ?><?= $champ=='motscles' ? 'categmots' : ''  ?>"><?= $infocategorie ?></td>
                                    <?php
                                    //
                                }
                            ?>
                                <td class="text-center">
                                    <button type="button" title="modifiez la categorie" id="<?= $idcategorie ?>" class="btn-xs btn btn-primary updateCategorie" data-toggle="modal" data-target="#formModifcategorie"><span class="glyphicon glyphicon-pencil"></span></button>
                                    
                                    <a href="?action=supprimer&id_categorie=<?= $idcategorie ?>" title="supprimer la categorie"><span class="glyphicon glyphicon-remove"></span></a>
                                    
                                </td>
                            </tr>
                            <?php
                        }
                ?>
                </table>

                <?php
            }
        
        $affichagecategories = ob_get_clean();


        //affichage de formulaire de modification
        ob_start();
        ?>
        <div id="formModifcategorie" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modifier ou ajouter la categorie</h4>
                    </div>
                    <form action="#" method="post">
                        <label for="titre" >titre</label>
                        <textarea class="form-control gettitrecateg" rows="2" name="titre" id="titre" cols="30" rows="10"></textarea>

                        <label for="mot-cle" >mot-cle</label>
                        <textarea class="form-control getmotscateg" rows="2" name="motscles" id="motscles" cols="30" rows="10"></textarea>

                        <div class="modal-body">
                                <!--<textarea class="form-control getcategorie" rows="3" name="categorie" id="categorie" cols="30" rows="10"></textarea> -->
                                <input type="hidden" id="inputIdcategorie" name="id_categorie" value="">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="valider" value="updateCategorie" class="btn btn-primary">
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
        <h1 class="text-center">Vous etes sur la gestion des categories</h1>
        <button type="button" title="ajouter la categorie" id="" class="btn-xs btn btn-primary " data-toggle="modal" data-target="#formModifcategorie">
        Aouter une catégorie</button>
        <?= $erreurAutorisation ?? '' ?>
        <?= $ajoutcateg ?? '' ?>
        <?= $miseajourcategorie ?? '' ?>
        <?= $suppressioncategorie ?? '' ?>
        <?= $affichagecategories ?? '' ?>
        <?= $modal ?? '' ?>
   <?php
    $content = ob_get_clean();

    include('../inc/gabarit.php');


