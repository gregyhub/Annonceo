<?php
    
    require_once('init.php');

    /*===========================
    ===========AJAX==============
    ============================ */
   //requete ajax pour tester le pseudo
    if( !empty($_POST) && isset($_POST['pseudo'])) {
        $libre = 'dispo';
        $sql = 'SELECT pseudo FROM membre WHERE pseudo=:pseudo';
        $verifPseudo = executeRequete($sql,  array('pseudo' => $_POST['pseudo']));
        if($verifPseudo->rowCount() != 0){
            $libre = 'nondispo';
        }
        echo $libre;
    }



    //update des infos du membre
    //recoit 4 paramètres
    //@val qui contient la valeur à mettre à jour
    //@champ qui correspond au champ à mettre à joru dans la table membre
    //@action=majmembre
    if(isset($_POST['action']) && $_POST['action'] == 'majmembre'){
        extract($_POST);
        //je vérifie que le pseuo soit disponible
        $sql = 'SELECT pseudo FROM membre WHERE pseudo=:pseudo';
        $verifPseudo = executeRequete($sql,  array('pseudo' => $val));
        if($verifPseudo->rowCount() != 0){
            //le pseudo n'est pas disponible
            $tab['validation'] ='ko';
        }else{
            //mettre à jour le membre
            $sql = 'UPDATE membre SET '.$champ.'=:valeur WHERE id_membre=:id_membre';
            $updateMembre = executeRequete($sql, array(
                                                    'valeur' => $val,
                                                    'id_membre' => $_SESSION['membre']['id_membre']));
            if($updateMembre->rowCount() == 1){
                //la maj s'est bien passée
                $tab['validation'] = 'ok';
                //je met à jour la Session
                $_SESSION['membre'][$champ] = $val;
            }
        }
        echo json_encode($tab);
    }



  //  action=filtre&val='+val+'&champ='+champ
  if(isset($_POST['action']) && $_POST['action'] ==filtre){
    $tabVal = explode(',',$_POST['val']);
    $tabChamp = explode(',',$_POST['champ']);

    foreach($tabVal as $val){
        if($val == 'no'){
            unset($tabVal);
            array_splice($tabChamp , $i, 1);
            vdm($tabChamp);
        }
    }

    $sql = 'SELECT id_annonce, titre, description_courte, photo, prix, prenom FROM annonce a, membre m WHERE a.membre_id=m.id_membre AND '.$_POST['champ'].'=:val';
    $filtreAnnonce = executeRequete($sql, array('val' => $_POST['val']));
    while($annonce = $filtreAnnonce->fetch(PDO::FETCH_ASSOC)){
        $tabAnnonce[] = $annonce;
    }
    echo json_encode($tabAnnonce);
  }

?>