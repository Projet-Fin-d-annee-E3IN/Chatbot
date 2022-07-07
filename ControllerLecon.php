<?php 
include_once 'Lecon.php';

if ($_POST['lecon'] == 'Passer au Question')
{ 
    $test = new Lecon($_POST['textLecon'],$_POST['cours']);
    $rep = $test->addQuestion($test->text,$test->idCours);

    header( "Location:http://localhost/chatbot/FormQuestion.php" );
}
elseif ($_POST['lecon'] == 'Autre leçon')
{ 
    $test = new Lecon($_POST['textLecon'],$_POST['cours']);
    $rep = $test->addQuestion($test->text,$test->idCours);
    header( "Location:http://localhost/chatbot/FormLecon.php" );
}
elseif ($_POST['lecon'] == 'Cours fini'){
    header( "Location:http://localhost/chatbot/FormCours.php" ); 
}