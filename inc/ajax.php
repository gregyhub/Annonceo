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


?>