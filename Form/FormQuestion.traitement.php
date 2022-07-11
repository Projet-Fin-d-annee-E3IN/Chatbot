<?php 
include_once '../Classe/Question.php';
session_start();

if ($_POST['FormQuestion'] == 'Ajouter Question')
{ 
    if($_POST['quest'] != null && $_POST['reponse'] != null && $_POST['lecon'] != null){
        $test = new Question($_POST['quest'],$_POST['reponse'],$_POST['lecon']);
        $rep = $test->addQuestion();
        header( "Location:http://localhost/chatbot/Form/FormQuestion.php" );
    }
}
elseif ($_POST['FormQuestion'] == 'retourner aux leçon')
{ 
    if($_POST['quest'] != null && $_POST['reponse'] != null && $_POST['lecon'] != null){
        $test = new Question($_POST['nomLecon'],$_POST['textLecon'],$_POST['cours']);
        $rep = $test->addQuestion();
        header( "Location:http://localhost/chatbot/Form/FormLecon.php" );
    }else{
        header( "Location:http://localhost/chatbot/Form/FormLecon.php" );
    }

}
elseif ($_POST['FormQuestion'] == 'Cours fini'){
    header( "Location:http://localhost/chatbot/Form/FormCours.php" ); 
}