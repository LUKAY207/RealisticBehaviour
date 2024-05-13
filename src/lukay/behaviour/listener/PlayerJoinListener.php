<?php

namespace lukay\behaviour\listener;

use JsonException;
use lukay\behaviour\session\Session;
use lukay\behaviour\session\SessionManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class PlayerJoinListener implements Listener{

    /**
     * @throws JsonException
     */
    public function onJoin(PlayerJoinEvent $event) : void{
        $sessionManager = SessionManager::getInstance();
        $sessionManager->create(new Session($event->getPlayer()));
    }
}