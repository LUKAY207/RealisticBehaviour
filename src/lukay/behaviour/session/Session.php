<?php

namespace lukay\behaviour\session;

use pocketmine\player\Player;

class Session{

    private readonly Player $player;
    private readonly string $identifier;

    public function __construct(Player $player){
        $this->player = $player;
        $this->identifier = $player->getUniqueId()->toString();
    }

    public function getPlayer() : Player{
        return $this->player;
    }

    public function getIdentifier() : string{
        return $this->identifier;
    }
}