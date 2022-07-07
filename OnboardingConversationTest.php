<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class OnboardingConversationTest extends Conversation
{

    protected $firstname;

    public function it_can_assert_replies()
    {
        $this->botman->hears('Quelle est votre nom?', function ($bot) {
            $bot->reply('hello!');
        });

        $this->tester->receives('message');
        $this->tester->assertReply('hello!');
    }
    
    public function it_can_assert_replies_are_not_present()
    {
        $this->botman->hears('Je s\'appelle Groot', function ($bot) {
        });

        $this->tester->receives('Je s\'appelle Groot');
        $this->tester->assertReplyNothing();
    }
    
}
