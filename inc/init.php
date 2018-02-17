<?php
    /*fichier sera inclus dans tous les scripts pour innitialiser les éléments suivants :
    -création/ouverture de session
    -connexion à la BDD site
    -definition du chemin du site
    -inclusion de notre ficher fonction utilisateur (fonction.php)
    */

    //session
    session_start();
    $pass='';
    $pass='mysql';

    //bdd
    $pdo = new PDO('mysql:host=localhost; dbname=annonceo','root', $pass, 
    array(
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'
    ));


    //chemin du site
    define('RACINE_SITE', '/Annonceo/');


    // Constantes pour les Photos
    define('MAX_SIZE', 100000);    // Taille max en octets du fichier
    define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
    define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels


    require_once('fonctions.php');
?>