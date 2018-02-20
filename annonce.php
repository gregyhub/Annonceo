<?php
    require_once('inc/init.php');


    if($_POST){

        $sql='INSERT INTO commentaire VALUES (NULL, :membre_id, :annonce_id,:commentaire, NOW())';
        $insert=executeRequete($sql, array(
                                        'membre_id' => $_SESSION['membre']['id_membre'],
                                        'annonce_id' => $_POST['annonce_id'],
                                        'commentaire' => $_POST['commentaire']
        ));
        header('location:annonce.php?id_annonce='. $_POST['annonce_id']);

    }


	if(isset($_GET['id_annonce'])){
		//je recoi bien le parametre dans l'url
		$sql = "SELECT *, c.titre as titrec, a.titre as titrea FROM annonce a, categorie c, membre m WHERE m.id_membre=a.membre_id AND c.id_categorie=a.categorie_id AND id_annonce = :id_annonce";
		$resul = executeRequete($sql,array('id_annonce' => $_GET['id_annonce'] ));
        $annonce = $resul->fetch(PDO::FETCH_ASSOC);
        

        //affichage des commentaires
        $sql='SELECT commentaire, c.date_enregistrement, prenom FROM commentaire c, membre m WHERE c.membre_id=m.id_membre AND annonce_id=:annonce_id';
        $commentaires = executeRequete($sql, array('annonce_id' =>$annonce['id_annonce'] ));
        ob_start();
        ?>
        <div class="row">
        <?php
        while($commentaire = $commentaires->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="col-md-12">
                <div class="list-group">
                    <h4 class="list-group-item-heading"><?= $commentaire['prenom'] ?> : <?= $commentaire['date_enregistrement'] ?></h4>
                    <p class="list-group-item-text"><?= $commentaire['commentaire'] ?></p>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        <?php
        $affCommentaires = ob_get_clean();



        //je prépare mon affichage photo
        $sql='SELECT * FROM photo where id_photo=:photo_id';
        $photos = executeRequete($sql, array('photo_id' => $annonce['photo_id']));
        $photos = $photos->fetch(PDO::FETCH_ASSOC);
        ob_start();
        ?>
        <div class="row">
        <?php
        foreach($photos as $index => $name){
            if($index != 'id_photo' && !empty($name)){
            ?>
            <div class="col-md-3 thumbnail" >
                <img class="img-responsive imgAnnonce" src="./inc/photos/<?= $name ?>" alt="" title="">
            </div>
            <?php
            }
        }
        ?>
        </div>
        <?php
        $photos = ob_get_clean();

		ob_start();
		?>
		<div id="principal" class="ligne">
				<main>  
				<p class="text-right"> <button type="submit" class="btn btn-primary">Contacter <?= $annonce['prenom'] ?></button></p>
				
					<img class="img-responsive imgAnnonce" src="./inc/photos/<?= $annonce['photo'] ?>" alt="<?= $annonce['titrea'] ?>" title="<?= $annonce['titrea'] ?>">
					
					<h2><?= $annonce['titrea'] ?></h2>
                    <p><?= $annonce['description_longue'] ?></p>
                    <?= $photos?>
                    
                    <div class="row">
                        <?php
                            if(estConnecte()){
                                ?>
                                    <p class="col-md-1"><button class="btn btn-default affichForm" role="button">deposez un commentaire</button></p>
                                <?php
                            }else{
                                ?>
                                    <p class="col-md-1"><a class="btn btn-default" role="button" href="connexion.php">Connectez vous pour laisser un commentaire</a></p>
                                <?php
                            }
                        ?>
                            
                           <p class="col-md-1 col-md-offset-8"> <a class="btn btn-default" role="button" href="index.php">retournez aux annonces</a></p>
                    </div>
                </main>
                <!-- affichage des commentaires -->
                <?=  $affCommentaires ?>


                <!-- formulaire de commentaire -->
                <div class="row">
                    <form id="fromCommentaire" action="" method="post">
                        <div class="form-group">
                            <label for="commentaire">Votre commentaire</label>
                            <textarea  class="form-control" name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                        </div>
                        <input type="hidden" name="annonce_id" value="<?= $annonce['id_annonce'] ?>">
                        <input type="submit" value="Enrgistrer">
                    </form>
                </div>

    </div id="container">

<?php
	$content = ob_get_clean();

	}
	else{
		//sinon afficher un message d'erreur
	}

	
?>
<!-- <nav class="navbar navbar-default">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-annonceo" href="#">Annonceo</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#"> Qui sommes-nous ?<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Contact</a></li>
        <li class="dropdown">

      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher">
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Espace membre</a></li>
  
        </li>
      </ul>
    </div>
  </div>
</nav>
<body>
    <div id="container">
			<header>
				<div class="header_a">
					<h1>Appartement</h1>
				</div>
				<div class="header_b">                     
                <button type="submit" class="btn btn-primary">Contacter Marie</button>
					
				</div>
			</header>
	
			
</body> -->
<?php
    include('inc/gabarit.php');

?>