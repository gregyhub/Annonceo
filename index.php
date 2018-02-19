<?php
    require_once('inc/init.php');

    //affichage des annonces
    $sql = 'SELECT id_annonce, titre, description_courte, photo, prix, prenom FROM annonce a, membre m WHERE a.membre_id=m.id_membre';
    $annonces = executeRequete($sql);
    ob_start();
    while($annonce = $annonces->fetch(PDO::FETCH_ASSOC)){
        ?>
        <a href="annonce.php?id_annonce=<?= $annonce['id_annonce'] ?>">
        <div class="list-group listeAnnonce">
            <div class="media">
                <div class="media-left media-middle">
                    <img class="media-object" src="./inc/photos/<?= $annonce['photo'] ?>" alt="<?= $annonce['titre'] ?>">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= $annonce['titre'] ?></h4>
                    <p><?= $annonce['description_courte'] ?></p>
                    <p><?= $annonce['prenom'] ?>
                    <?= $annonce['prix'] ?>€</p>
                </div>
            </div>
          </div>
          </a>
        <?php
    }
    $affichage = ob_get_clean();
  
    
    ob_start();
    //gestion des filtres
    //un filtres catégorie
    $sql = 'SELECT DISTINCT titre, id_categorie FROM categorie';
    $categories = executeRequete($sql);
    ?>
    <label for="categorie_id">Catégories</label><br>
    <select class="form-control ajaxSearch" data="categorie_id" name="categorie_id" id="categorie_id">
        <option value="no">selectionnez une catégorie</option>
    <?php
        //boucle pour afficher les catégories
        while($categorie = $categories->fetch(PDO::FETCH_ASSOC)){
            ?>
            <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie['titre'] ?></option>
            <?php
        }
    ?>
    </select>
    <?php
    //filtres villes
    $sql = 'SELECT DISTINCT ville FROM annonce';
    $villes = executeRequete($sql);
    ?>
    <label for="ville">Ville</label><br>
    <select class="form-control ajaxSearch" data="ville" name="ville" id="ville">
        <option value="no">selectionnez une catégorie</option>
    <?php
        //boucle pour afficher les catégories
        while($ville = $villes->fetch(PDO::FETCH_ASSOC)){
            ?>
            <option value="<?= $ville['ville'] ?>"><?= $ville['ville'] ?></option>
            <?php
        }
    ?>
    </select>
    <?php

    $filtres = ob_get_clean();

    ob_start();
	?>
    <div class="row">
        <div class="col-md-3">
            <?= $filtres ?>
        </div>
        <div class="col-md-8 col-md-offset-1">
            <div class="row innerAjax">
                 <?= $affichage ?>
            </div>
        </div>
    </div>
    <?php
	$content = ob_get_clean();


    include('inc/gabarit.php');

?>