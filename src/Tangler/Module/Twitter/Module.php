<?php

namespace Tangler\Module\Twitter;

use Tangler\Core\AbstractModule;
use Tangler\Core\Interfaces\ModuleInterface;

class Module extends AbstractModule implements ModuleInterface
{
    public function Init()
    {
        $this->setKey('twitter');
        $this->setLabel('Twitter module');
        $this->setDescription('Interact with your Twitter account');
        $this->setImageUrl('http://ss.utpb.edu/media/images/student-life/twitter_icon.png');

        // No triggers
        $this->setTriggers(array());

        $this->setActions(array(
            new \Tangler\Module\Twitter\SendTweetAction()
        ));
    }
}
