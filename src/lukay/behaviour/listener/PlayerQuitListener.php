<?php

namespace lukay\behaviour\listener;

use lukay\behaviour\session\SessionManager;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;

class PlayerQuitListener implements Listener{

    public function onQuit(PlayerQuitEvent $event) : void{
        $sessionManager = SessionManager::getInstance();
        $sessionManager->destroy($sessionManager->get($event->getPlayer()));
    }
}