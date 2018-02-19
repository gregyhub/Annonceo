<?php
/*  =============================================================================================================
=================== FONCTIONS ADMIN ============================================================================= 
===============================================================================================================*/
    function vdm($e, $ex = ''){
        echo '<pre>';
        var_dump($e);
        echo '</pre>';
        if($ex == "ex"){
            exit;
        }
    }
    /*
    FONCTION pour executer les requetes
    */
    function executeRequete($sql, $params=array()) {
        if(!empty($params)){
            foreach($params as $indice => $param){
                $params[$indice] = htmlspecialchars($param, ENT_QUOTES);
            }
         }
         global $pdo;
         $r = $pdo->prepare($sql);
         $r->execute($params);

         if( !empty($r->errorInfo()[2])){
             die('<p class="label label-danger">Erreur rencontrée pendant la requete. <br> Message : '.$r->errorInfo()[2].'</p>');
         }
         return $r;
    }

    /*
    fonctin pour vérifier si les champs formulaire son vide ou non
    @champs est un tableau array qui contien en index le nom du champ a inserer en base, qui provient du "name" du formulaire, et en valeur, la valeur a envoyer en base
    */
    function champVide($champs){
        $champsvides = array('nbError' => 0);
        $champsvalides = array();
        $i=0;
        foreach($champs as $indice => $valeur){
            if(empty($valeur) xor $valeur==" "){
                $champsvides[$indice]='<div class="alert alert-danger" role="alert">Vous devez saisir votre '.$indice.' pour valider le formulaire.</div>';
                $i++;
            }else{
                $champsvalides[$indice] = $valeur;
            }
        }
        
        $champsvides['nbError']=$i;
        return array('champsvides' => $champsvides, 'champsvalides' => $champsvalides);
    }



    function UploadPhoto ($file) {
 
        // Variables
        $extension = '';
        $message = '';
        $nomImage = '';

        /************************************************************
         * Script d'upload
         *************************************************************/
        // Recuperation de l'extension du fichier
        $extension  = pathinfo($file['name'], PATHINFO_EXTENSION);
        // On renomme le fichier
        $nomImage = md5(uniqid()) .'.'. $extension;
        // on teste l'upload
        if(move_uploaded_file($file['tmp_name'], 'inc/photos/'.$nomImage)){
            $message = 'Upload réussi !';
        }
        else{
            // Sinon on affiche une erreur systeme
            $message = 'Problème lors de l\'upload !';
        }
        return array('nom' => $nomImage, 'message' => $message);
    } //fin fonction









    function estConnecteEtAdmin() {
        if(estConnecte() && $_SESSION['membre']['statut']==1){
            return true;
        }
        else{
            return false;
        }
    }

    function estConnecte() {
        if(isset($_SESSION['membre'])){
            return true;
        }
        else{
            false;
        }
    }
   
   
?>