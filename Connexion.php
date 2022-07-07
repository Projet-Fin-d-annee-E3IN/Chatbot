<?php

function connecDataBase(){
    // Database settings
    $db="projetlab";
    $dbhost="localhost";
    $dbport=3306;
    $dbuser="root";
    $dbpasswd="";
    try{
    $pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
    $pdo->exec("SET CHARACTER SET utf8");
    echo 'Je suis co';
    }
    catch(PDOException $e){
        print "Erreur vous êtes non connecté ! erreur en cours : " . $e->getMessage() . "";
    }
    return $pdo;
}
?>