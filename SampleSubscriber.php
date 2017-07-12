<?php

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SampleSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'my.event' => 'onMyEvent',
        ];
    }

    public function onMyEvent()
    {
        echo 'My event triggered!';
    }
}
