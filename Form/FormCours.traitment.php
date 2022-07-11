<?php 
include_once '../Classe/Cours.php';
    if($_POST['nom'] != null){
        $test = new Cours($_POST['nom']);
        $rep = $test->addCours();
        header( "Location:http://localhost/chatbot/Form/FormLecon.php" );
    }else{
        header( "Location:http://localhost/chatbot/Form/FormLecon.php" );
    }

