<?php

namespace lukay\behaviour;

use lukay\behaviour\listener\PlayerJoinListener;
use lukay\behaviour\listener\PlayerQuitListener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase{
    use SingletonTrait;

    private Config $config;

    protected function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents(new PlayerJoinListener(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerQuitListener(), $this);

        $this->config = new Config(Loader::getInstance()->getDataFolder() . 'sessions.json', Config::JSON);
    }

    public function getSessions() : Config{
        return $this->config;
    }
}