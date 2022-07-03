<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class OnboardingConversation extends Conversation
{

    protected $firstname;

    public function askFirstname()
    {
        $this->ask('Quelle est votre nom?', function($answer) {
            $firstName = $answer->getText();
            $this->say('Bienvenue '.$firstName.', Notre chat bot de cours en ligne est a votre disposition pour vous aider au cours de votre apprentissage');
            // $this->askForDatabase();
            $this->askCours();
        }); 

    }


    public function run()
    {
        $this->askFirstname();
    }


    protected function askCours(){
        $question = Question::create('Sur quelle cours souhaitez-vous vous penchez ?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('verbe irrégulier')->value('verbe irrégulier'),
            Button::create('Possession')->value('Possession'),
        ]);

    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
            if($selectedValue == 'Possession'){
                $this->say('Il existe 3 formules pour traduire la possession :  \'s   ou bien   \' ou bien encore, la tournure avec  of.

                \'s : employé lorsque le possesseur est un humain ou un animal familier (a pet), au singulier ainsi qu\'au pluriel dans le cas de pluriels irréguliers uniquement (children, men, women...)
                
                ex: Paul\'s car (la voiture de Paul) / the children\'s room (la chambre des enfants)
                
                \' : employé lorsque les possesseurs sont des humains ou des animaux familiers (pets) et sont au pluriel.
                
                ex : my parents\' car (la voiture de mes parents)
                
                of : le (ou les) possesseur est une chose, un animal pas familier. (le coffre de la voiture).
                ex : the tail of the cow  (la queue de la vache)');
            };
            $this->askQuestionPossesion();
        }

    });
    }

    protected function askQuestionPossesion(){
        $question = Question::create('On passe au question ?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Oui')->value('Oui'),
            Button::create('Non')->value('Non'),
        ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
                if($selectedValue == 'Oui'){
                    $question = Question::create('La traduction de la voiture de lea est :')
                    ->fallback('Unable to create a new database')
                    ->callbackId('create_database')
                    ->addButtons([
                        Button::create('Lea\'s car')->value('Oui'),
                        Button::create('car of lea')->value('Non'),
                    ]);
                    $this->ask($question,function (Answer $answer){
                        if ($answer->isInteractiveMessageReply()) {
                            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
                            $selectedText = $answer->getText();
                            if($selectedValue == 'Oui'){
                                $this->say('Bonne reponse');
                            }
                        }
                    });

                }
                
            };
            
        });

    }
    
}
