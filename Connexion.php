<?php

function connecDataBase(){
    // Database settings
    $db="projetlab";
    $dbhost="localhost";
    $dbport=3306;
    $dbuser="root";
    $dbpasswd="root";
    try{
    $pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.'', $dbuser, $dbpasswd);
    $pdo->exec("SET CHARACTER SET utf8");
    }
    catch(PDOException $e){
        print "Erreur vous êtes non connecté ! erreur en cours : " . $e->getMessage() . "";
    }
    return $pdo;
}

function listCours() {
    $lesLecons = array();
    $pdo = connecDataBase();
    
    if ($pdo != NULL)
    {
        $req = 'SELECT * FROM cours';
        $pdoStatement = $pdo->query($req);
        $lesLecons = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    $pdo = null;
    return $lesLecons;
}

function listNotion() {
    session_start();
    $lesLecons = array();
    $pdo = connecDataBase();
    $idCours = $_SESSION['idCours'];
    if ($pdo != NULL)
    {
        $req = "SELECT * FROM lecon WHERE idCours = $idCours";
        $pdoStatement = $pdo->query($req);
        $lesLecons = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    $pdo = null;
    
    return $lesLecons;
}

function listNotionForChatBot() {
    $lesLecons = array();
    $pdo = connecDataBase();
    if ($pdo != NULL)
    {
        $req = "SELECT * FROM lecon";
        $pdoStatement = $pdo->query($req);
        $lesLecons = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $lesLecons;
}

function listQuest() {
    $lesQuestions = array();
    $pdo = connecDataBase();
    if ($pdo != NULL)
    {
        $req = "SELECT * FROM question";
        $pdoStatement = $pdo->query($req);
        $lesQuestions = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    return $lesQuestions;
}
?>