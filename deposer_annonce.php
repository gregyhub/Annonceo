<?php
    require_once('inc/init.php');
    if($_POST && estConnecte()){
        //enregistrer l'annonce
        $controleChamps=champVide($_POST);
        $errorInscription = $controleChamps['champsvides'];

        if($errorInscription['nbError']==0) {
            //il n'y a pas de champs vide donc je continue de tester les champs

            $verif_cp = preg_match('#^[0-9]{5}$#', $_POST['cp']);
            /*
                # - delimite l'expression au début et à la fin
                ^ signifie commence par tout ce qui suit
                $ signifie finit par tout ce qui précède
                [] pour delimiter les intervals
                + pour dire que les caractères sont accepté de 0 à x fois.
            */

            //pas d'erreur donc j'ajoute le membre dans la base
            $listeChamps =  $controleChamps['champsvalides'];

            //controle sur les photos
            $uploadPhoto=array();
            for($i=1;$i<=5;$i++){
                $y=$i-1;
                $uploadPhoto[$y] = '';
                if(!empty($_FILES['photo'.$i]['name'])){
                    $uploadPhoto[$y] = UploadPhoto($_FILES['photo'.$i]);
                }
            }

            //si mon tableau $uploadPhoto est = 0 alors il n'y a pas de photo
            //si mon tableau $uploadPhoto est = 1 alors il y a juste une photo principale
            //si mon tableau $uploadPhoto est > 1 alors il ya une photo principale  et d'autres photo a ajouter dans la table PHOTO
            if(count($uploadPhoto)==0){
                $listeChamps['photo'] = '';
                $listeChamps['photo_id'] = NULL;
                
            }elseif(count($uploadPhoto)==1){
                $listeChamps['photo'] = $uploadPhoto[0]['nom'];
                $listeChamps['photo_id'] = NULL;
            }else{
                $listeChamps['photo'] = $uploadPhoto[0]['nom'];
                $nbphoto = count($uploadPhoto) -1; //-1 car la premiere photo sera dans la table annonce, les autres dans la table photo
                for($i=$nbphoto-1; $i <= 4 ;$i++){
                    $uploadPhoto[$i]=array('nom' => NULL);
                }
               
                $sql = 'INSERT INTO photo VALUES (NULL, :photo1, :photo2, :photo3,:photo4)';
                $insertPhotos = executeRequete($sql, array(
                                                       'photo1' => $uploadPhoto[1]['nom'],
                                                       'photo2' => $uploadPhoto[2]['nom'],
                                                       'photo3' => $uploadPhoto[3]['nom'],
                                                       'photo4' => $uploadPhoto[4]['nom']
                ));
                $id = $pdo->lastInsertId();
                $listeChamps['photo_id'] = $id;

            }

          
            $listeChamps['membre_id']= $_SESSION['membre']['id_membre'];
            
            vdm($listeChamps);
            $sql = "INSERT INTO annonce values (NULL, :titre, :description_courte, :description_longue, :prix, :photo , :pays, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, CURDATE())";
          
            $insert = executeRequete($sql,$listeChamps);
           
        }
    }


    //récupérer les catégories de la base de données
    $sql = 'SELECT DISTINCT titre, id_categorie FROM categorie';
    $categories = executeRequete($sql);
    



/**
 * FORMULAIRE POUR DEPOSER UNE ANNONCE
 * 
 */
    ob_start();
?>
    <form id="ajoutAnnonce" action="" method="post" enctype="multipart/form-data">
        <div class="form-group <?= isset($errorInscription['titre']) ? 'has-error' : '' ?>">
            <label for="titre">titre</label>
            <input type="text" class="form-control" id="titre" name="titre" placeholder="saisissez votre titre" 
            value="<?= $_POST['titre'] ?? '' ?>">
            <?= $errorInscription['titre'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['description_courte']) ? 'has-error' : '' ?>">
            <label for="description_courte">description_courte</label>
            <input type="text" class="form-control" id="description_courte" name="description_courte" 
            placeholder="saisissez la description_courte de votre annonce" 
            value="<?= $_POST['description_courte'] ?? '' ?>">
            <?= $errorInscription['description_courte'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['description_longue']) ? 'has-error' : '' ?>">
            <label for="description_longue">description_longue</label>
            <input type="text" class="form-control" id="description_longue" name="description_longue" 
            placeholder="saisissez la description_longue de votre annonce" 
            value="<?= $_POST['description_longue'] ?? '' ?>">
            <?= $errorInscription['description_longue'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['prix']) ? 'has-error' : '' ?>">
            <label for="prix">prix</label>
            <input type="text" class="form-control" id="prix" name="prix" 
            placeholder="saisissez le prix de votre annonce" 
            value="<?= $_POST['prix'] ?? '' ?>">
            <?= $errorInscription['prix'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['categorie_id']) ? 'has-error' : '' ?>">
            <label for="categorie_id">categorie</label>
            <select name="categorie_id" id="categorie_id">
            <?php
                //boucle pour afficher les catégories
                while($categorie = $categories->fetch(PDO::FETCH_ASSOC)){
                    vdm($categorie);
                    ?>
                    <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie['titre'] ?></option>
                    <?php
                }
            ?>
            </select>
            <?= $errorInscription['categorie_id'] ?? '' ?>
        </div>
        <div class="form-group">
            <label>photo</label>
            <label for="photo1">
                <div class="btn btn-default btn-lg">
                    <span>photo1</span>
                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                </div>
            </label>
            <input type="file" class="typeFile" name="photo1" id="photo1">
            <img class="viewPhoto" src="#" alt="your image" />
            
            <label for="photo2" class="typeFile">
                <div class="btn btn-default btn-lg">
                    <span>photo2</span>
                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                </div>
            </label>
            <input type="file" class="typeFile" name="photo2" id="photo2">
            <img class="viewPhoto" src="#" alt="your image" />

            <label for="photo3" class="typeFile">
                <div class="btn btn-default btn-lg">
                    <span>photo3</span>
                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                </div>
            </label>
            <input type="file" class="typeFile" name="photo3" id="photo3">
            <img class="viewPhoto" src="#" alt="your image" />

            <label for="photo4" class="typeFile">
                <div class="btn btn-default btn-lg">
                    <span>photo4</span>
                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                </div>
            </label>
            <input type="file" class="typeFile" name="photo4" id="photo4">
            <img class="viewPhoto" src="#" alt="your image" />

            <label for="photo5" class="typeFile">
                <div class="btn btn-default btn-lg">
                    <span>photo5</span>
                    <span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
                </div>
            </label>
            <input type="file" class="typeFile" name="photo5" id="photo5">
            <img class="viewPhoto" src="#" alt="your image" />
        </div>

        <div class="form-group <?= isset($errorInscription['pays']) ? 'has-error' : '' ?>">
            <label for="pays">pays</label>
            <input type="text" class="form-control" id="pays" name="pays" 
            placeholder="saisissez le pays de votre annonce" 
            value="<?= $_POST['pays'] ?? '' ?>">
            <?= $errorInscription['pays'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['ville']) ? 'has-error' : '' ?>">
            <label for="ville">ville</label>
            <input type="text" class="form-control" id="ville" name="ville" 
            placeholder="saisissez la ville de votre annonce" 
            value="<?= $_POST['ville'] ?? '' ?>">
            <?= $errorInscription['ville'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['adresse']) ? 'has-error' : '' ?>">
            <label for="adresse">adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" 
            placeholder="saisissez l'adresse de votre annonce" 
            value="<?= $_POST['adresse'] ?? '' ?>">
            <?= $errorInscription['adresse'] ?? '' ?>
        </div>

        <div class="form-group <?= isset($errorInscription['cp']) ? 'has-error' : '' ?>">
            <label for="cp">code postal</label>
            <input type="text" class="form-control" id="cp" name="cp" 
            placeholder="saisissez le code postal de votre annonce" 
            value="<?= $_POST['cp'] ?? '' ?>">
            <?= $errorInscription['cp'] ?? '' ?>
        </div>

        <input type="submit" class="btn btn-primary" value="enregistrer">
    </form>
<?php
    $content = ob_get_clean();




    include('inc/gabarit.php');

?>