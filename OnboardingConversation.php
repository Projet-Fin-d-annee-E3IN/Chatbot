<?php
    session_start();
include_once 'Connexion.php';
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;


//Creation de la class conversation avec le bot
class OnboardingConversation extends Conversation
{

    //Demmarre la fonction askCours
    public function run()
    {
        $this->askCours();
    }

    //Fonction AskCours demmande quelle cours l'etudiant veut suivre

    protected function askCours(){
        

        foreach ($_SESSION['cours'] as $cours) {
            $button = Button::create($cours['nom'])->value($cours['idCours']);
            $buttonArray[] = $button;
        }
        $this->say('Welcome to our online course chat bot is at your disposal to help you during your learning');
        $question = Question::create('Which course do you want to study ?')
        ->addButtons($buttonArray);
    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            // $this->say($selectedValue);
            $this->botNotion($selectedValue);
        }

    });
    }

    protected function botNotion($idCours){
        $_SESSION['idCours'] = $idCours;
        foreach ($_SESSION['lecon'] as $lecons) {
            if($idCours == $lecons['idCours']){
                $button = Button::create($lecons['nomLecon'])->value($lecons['idLecon']);
                $buttonArrayN[] = $button;
            }
        }
        $button = Button::create('Return select Cours')->value('Return Cours');
        $buttonArrayN[] = $button;
        $question = Question::create('Select Notion :')
        ->addButtons($buttonArrayN);
    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            if($selectedValue == "Return Cours"){
                $this->askCours();
            }
            else{
                foreach ($_SESSION['lecon'] as $lecons) {
                    if($selectedValue == $lecons['idLecon']){
                        $textNotion = $lecons['text'];
                    }
                }
                $this->say($textNotion);
                $this->botQuestion($selectedValue);
                         
            }
            }       
    });

    }

    protected function botQuestion($idLecon){
        $_SESSION['idLecon'] = $idLecon;
        $conteur = 1;
        foreach ($_SESSION['quest'] as $quest) {
            if($quest['idLecon'] == $idLecon){
                $button = Button::create($conteur)->value($quest['idQuestion']);
                $buttonArrayQ[] = $button;
                $conteur = $conteur + 1;
            }
        }
        $button = Button::create('Return select Cours')->value('Return Cours');
        $buttonArrayQ[] = $button;
        $button = Button::create('Return select notion')->value('Return Notion');
        $buttonArrayQ[] = $button;
        $question = Question::create('Select question number : ')
        ->addButtons($buttonArrayQ);
    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            // $this->say($selectedValue);
            if($selectedValue == "Return Cours"){
                $this->askCours();
            }            
            elseif($selectedValue == "Return Notion"){
                $this->botNotion($_SESSION['idCours']);
            }
            else{
                $this->askQuest($selectedValue);
            }
        }

    });
    }
    

    protected function askQuest($idQuest){
        $_SESSION['idQuest'] = $idQuest;
        foreach ($_SESSION['quest'] as $quest) {
            if($quest['idQuestion'] == $idQuest){
                $question = $quest;
                $_SESSION['rep'] = $quest['reponse'];
            }
        }
                    $this->ask($question['quest'],function (Answer $answer){
                        $reponse = $answer->getText();
                            if($reponse == $_SESSION['rep']){
                                $this->say('Good');
                                $this->botQuestion($_SESSION['idLecon']);
                            }else{
                                $this->say('Not good');
                                $this->askQuest($_SESSION['idQuest']);
                            }
                        
                    });


    }
   
}
