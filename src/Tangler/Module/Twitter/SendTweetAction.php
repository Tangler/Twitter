<?php

namespace Tangler\Module\Twitter;

use Tangler\Core\Interfaces\ActionInterface;
use Tangler\Core\AbstractAction;
use TwitterAPIExchange;

class SendTweetAction extends AbstractAction implements ActionInterface
{
    public function Init()
    {
        $this->setKey('send_tweet');
        $this->setLabel('Send tweet action');
        $this->setDescription('This action sends a new Tweet');

        $this->parameter->defineParameter('oauth.accesstoken', 'string', 'Oauth access token');
        $this->parameter->defineParameter('oauth.accesstoken.secret', 'string', 'Oauth access token secret');
        $this->parameter->defineParameter('consumer.key', 'string', 'Consumer key');
        $this->parameter->defineParameter('consumer.secret', 'string', 'Consumer secret');
        $this->parameter->defineParameter('message', 'string', 'Message contents');
    }

    public function Run($input)
    {
        /*
        $token = $this->resolveParameter('token', $input);
        $userkey = $this->resolveParameter('userkey', $input);
        */
        $message = $this->resolveParameter('message', $input);

        echo "\n### SendTweetAction: " . $message . "\n";
        $settings = array(
            'oauth_access_token' => $this->resolveParameter('oauth.accesstoken', $input),
            'oauth_access_token_secret' => $this->resolveParameter('oauth.accesstoken.secret', $input),
            'consumer_key' => $this->resolveParameter('consumer.key', $input),
            'consumer_secret' => $this->resolveParameter('consumer.secret', $input)
        );

        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $postfields = array(
            'status' => $message, 
            'skip_status' => '1'
        );
        $requestMethod = 'POST';

        $twitter = new TwitterAPIExchange($settings);
        echo $twitter->buildOauth($url, $requestMethod)
            ->setPostfields($postfields)
            ->performRequest();
    }
}
