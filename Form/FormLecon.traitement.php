<?php 
include_once '../Classe/Lecon.php';
session_start();

if ($_POST['lecon'] == 'Passer au question du cours')
{ 
    if($_POST['nomLecon'] != null && $_POST['textLecon'] !=null && $_POST['cours'] != null)
{    $_SESSION['idCours'] = $_POST['cours'];
    $test = new Lecon($_POST['nomLecon'],$_POST['textLecon'],$_POST['cours']);
    $rep = $test->addQuestion();

    header( "Location:http://localhost/chatbot/Form/FormQuestion.php" );
}else{
    $_SESSION['idCours'] = $_POST['cours'];
    header( "Location:http://localhost/chatbot/Form/FormQuestion.php" );
}
}
elseif ($_POST['lecon'] == 'Nouvelle leçon')
{ 
    if($_POST['nomLecon'] != null && $_POST['textLecon'] !=null && $_POST['cours'] != null)
{   
    $test = new Lecon($_POST['nomLecon'],$_POST['textLecon'],$_POST['cours']);
    $rep = $test->addQuestion();
}

    header( "Location:http://localhost/chatbot/Form/FormLecon.php" );
}
elseif ($_POST['lecon'] == 'Creation Cours fini'){
    header( "Location:http://localhost/chatbot/Form/FormCours.php" ); 
}