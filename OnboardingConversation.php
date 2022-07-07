<?php
include_once 'Lecon.php';
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
    protected function askCours(){;

        $this->say('Welcome to our online course chat bot is at your disposal to help you during your learning');
        $question = Question::create('Which course do you want to study ?')
        ->fallback('Unable to create a new database')
        ->callbackId('create_database')
        ->addButtons([
            Button::create('Article in english')->value('Article'),
        ]);
    $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
            //donne un cours sur les articles si selectionner
            if($selectedValue == 'Article'){
                $this->say('An article is a word that defines a noun.
                There are two types of articles in English, the definite article “the” and the  indefinite article “a”.
                ');
                $this->say('
                Master Crow, perched on a tree,
                Holding in its beak a cheese.
                Master Fox, enticed by the smell,
                He held this language more or less');
            };
            $this->askQuestionNotion1();
        }

    });
    }

    protected function askQuestionNotion1(){
                    $this->ask('How many articles do you see in the following text ?',function (Answer $answer){
                        $reponse = $answer->getText();
                            if($reponse == '3'){
                                $this->say('Good');
                                $this->askNotion2();
                            }else{
                                $this->say('Not good');
                                $this->askQuestionNotion1();
                            }
                        
                    });


    }

    protected function askNotion2(){
        $question = Question::create('Next notion')
        ->addButtons([
            Button::create('Next')->value('yes'),
        ]);


        $this->say('Definite article :        
        The definite article “the” is used to specify that the noun refers to one particular item.
        Exemple : In the house there is a table.
        It can also be used to refer to a general item that has already been defined.
        Exemple : In the house there is a table. The table is black.
        ');

        $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $selectedValue = $answer->getValue(); // will be either 'yes' or 'no'
            $selectedText = $answer->getText(); // will be either 'Of course' or 'Hell no!'
            //donne un cours sur les articles si selectionner
            if($selectedValue == 'yes'){
                $this->say('Indefinite article :        The indefinite article takes two forms. It’s the word “a” when it precedes a word that begins with a consonant. It’s the word “an” when it precedes a word that begins with a vowel. The indefinite article indicates that a noun refers to a general idea rather than a particular thing.
                Exemple : Ms Smith is in a hotel room.
                         Ms Smith has an umbrella
                It can also be used to introduce something for the first time in a text. 
                Exemple : Ms Smith has got two pieces of luggage : a suitcase and a handbag.');
                $this->say('Choose the correct article :');
                $this->asknotion2_3();
            }
            else{            
                $this->askQuestionNotion1();
            }
        }

        });



    }

    protected function asknotion2_3(){
        $this->ask('Our cat is ….. blue one.',function (Answer $answer){
            $reponse = $answer->getText();
                if($reponse == 'a'){
                    $this->say('Good');
                    $this->ask('Do you have ….. cat.',function (Answer $answer){
                        $reponse = $answer->getText();
                            if($reponse == 'a'){
                                $this->say('Good');
                                $this->ask('There is ….. cat.',function (Answer $answer){
                                    $reponse = $answer->getText();
                                        if($reponse == 'a'){
                                            $this->say('Good');
                                            $this->ask('It is raining today, I need to take ….. umbrella.',function (Answer $answer){
                                                $reponse = $answer->getText();
                                                    if($reponse == 'a'){
                                                        $this->say('Good');
                                                        $this->askNotion4();
                                                    }else{
                                                        $this->say('Not good');
                                                        $this->asknotion2_3();
                                                    }
                                                
                                            });
                                        }else{
                                            $this->say('Not good');
                                            $this->asknotion2_3();
                                        }
                                    
                                });
                            }else{
                                $this->say('Not good');
                                $this->asknotion2_3();
                            }
                        
                    });
                }else{
                    $this->say('Not good');
                    $this->asknotion2_3();
                }
            
        });

    }

    protected function askNotion4(){
        $question = Question::create('Next Exception')
        ->addButtons([
            Button::create('Next exception')->value('yes'),
        ]);

        $this->say('Sometimes articles are omitted, in these cases the article is implied but not present. The implied article or “zero article” often refers to abstract ideas.');
        $this->ask($question, function (Answer $answer) {
        // Detect if button was clicked:
        if ($answer->isInteractiveMessageReply()) {
            $this->say('Plural nouns that refers to undetermined or uncountable things
            Exemple : Please give me some water 
                     Please give a bottle of water ');
                     
                     $question = Question::create('Next Exception')
                     ->addButtons([
                         Button::create('Next exception')->value('yes'),
                     ]);
             
                     $this->ask($question, function (Answer $answer) {
                        // Detect if button was clicked:
                        if ($answer->isInteractiveMessageReply()) {
                            $this->say('Continents, cities, streets, lakes, places
                             Exemple : Ms Smith is in Dublin. Her hotel is in Merrion Street between Fitzwilliam Square and Merrion Park.');
                             
                             $question = Question::create('Next Exception')
                             ->addButtons([
                                 Button::create('Next exception')->value('yes'),
                             ]);
                     
                             $this->ask($question, function (Answer $answer) {
                                // Detect if button was clicked:
                                if ($answer->isInteractiveMessageReply()) {
                                    $this->say('Countries
                                     Exemple : Dublin is in Ireland.
                                     But there are exceptions for the Netherlands and nouns composed of Kingdom, Republic, State, Union, Federation.
                                     Exemple : Miami is in the United States.
                                                      We go to the Netherlands every summer.');
                                     $question = Question::create('Next Exception')
                                     ->addButtons([
                                         Button::create('Next exception')->value('yes'),
                                     ]);
                             
                                     $this->ask($question, function (Answer $answer) {
                                        // Detect if button was clicked:
                                        if ($answer->isInteractiveMessageReply()) {
                                            $this->say('Days of the week
                                            Exemple : She traveled to Ireland in May. She arrived on Monday.
                                            Exception if there is a complement that requires an article.
                                            Exemple : She arrived on a rainy Monday.');
                                             $question = Question::create('Next Exception')
                                             ->addButtons([
                                                 Button::create('Next exception')->value('yes'),
                                             ]);
                                     
                                             $this->ask($question, function (Answer $answer) {
                                                // Detect if button was clicked:
                                                if ($answer->isInteractiveMessageReply()) {
                                                    $this->say('Institutions 
                                                    Exemple : The children go to school.
                                                    But  “Her son and my daughter go to the same school.” because there is the complement “same”.');
                                                     $question = Question::create('Next Exception')
                                                     ->addButtons([
                                                         Button::create('Next exception')->value('yes'),
                                                     ]);
                                             
                                                     $this->ask($question, function (Answer $answer) {
                                                        // Detect if button was clicked:
                                                        if ($answer->isInteractiveMessageReply()) {
                                                            $this->say('Structures with “go by” or “play”
                                                             Go by :
                                                             Exemple : Ms Smith said we should go by train.
                                                             Play something :
                                                             Exemple : Ms Smith plays tennis.
                                                             Exception for music instruments 
                                                             Exemple : Ms Smith plays the guitar.');
                                                             $question = Question::create('Next Exception')
                                                             ->addButtons([
                                                                 Button::create('Next exception')->value('yes'),
                                                             ]);
                                                     
                                                             $this->ask($question, function (Answer $answer) {
                                                                // Detect if button was clicked:
                                                                if ($answer->isInteractiveMessageReply()) {
                                                                    $this->say('Tell if there is an exception, and so, no article needed, or choose the right article.(exception/a/an/the)');
                                                                    $this->askQuestNotion4();       
                                                                }
                                                        
                                                                });      
                                                        }
                                                
                                                        });        
                                                }
                                        
                                                });      
                                        }
                                
                                        });       
                                }
                        
                                });     
                        }
                
                        });
                     
        }

        });

    }
    protected function askQuestNotion4(){
        $this->ask('I’m thirsty, do you have . . . water ?',function (Answer $answer){
            $reponse = $answer->getText();
                if($reponse == 'exception'){
                    $this->say('Good');
                    $this->ask('Please give me …. bottle of water.',function (Answer $answer){
                        $reponse = $answer->getText();
                            if($reponse == 'a'){
                                $this->say('Good');
                                $this->ask('Meet me in …. Paris tomorrow.',function (Answer $answer){
                                    $reponse = $answer->getText();
                                        if($reponse == 'exception'){
                                            $this->say('Good');
                                            $this->ask('My cousin lives in …. Australia.',function (Answer $answer){
                                                $reponse = $answer->getText();
                                                    if($reponse == 'exception'){
                                                        $this->say('Good you expert in article now');
                                                        $this->askNotion4();
                                                    }else{
                                                        $this->say('Not good');
                                                        $this->asknotion2_3();
                                                    }
                                                
                                            });
                                        }else{
                                            $this->say('Not good');
                                            $this->asknotion2_3();
                                        }
                                    
                                });
                            }else{
                                $this->say('Not good');
                                $this->asknotion2_3();
                            }
                        
                    });
                }else{
                    $this->say('Not good');
                    $this->asknotion2_3();
                }
            
        });

    }
}
