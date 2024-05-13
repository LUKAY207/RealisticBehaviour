<?php /** @noinspection ALL */

namespace lukay\behaviour\session;

use JsonException;
use lukay\behaviour\Loader;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;

class SessionManager{
    use SingletonTrait;

    /**
     * @var Session[]
     */
    private array $sessions;

    /**
     * @throws JsonException
     */
    public function create(Session $session) : void{
        if(!isset($this->sessions[$session->getIdentifier()])) $this->sessions[$session->getIdentifier()] = $session;

        $sessions = Loader::getInstance()->getSessions();

        if(!$sessions->exists($session->getIdentifier())) {
            $sessions->set($session->getIdentifier(), $session);
            $sessions->save();
            $sessions->reload();
        }
    }

    public function destroy(Session $session) : void{
        if(isset($this->sessions[$session->getIdentifier()])) unset($this->sessions[$session->getIdentifier()]);
    }

    /**
     * Sessions needs to be reloaded after every data change
     * @return void
     */
    public function reload(Session $session) : void{
        $this->sessions[$session->getIdentifier()] = $session;

        $sessions = Loader::getInstance()->getSessions();
        $sessions->set($session->getIdentifier(), $session);
        $sessions->save();
        $sessions->reload();
    }

    public function get(Player $player) : ?Session{
        return $this->sessions[$player->getUniqueId()->toString()];
    }

    /**
     * Returns all sessions of online players
     * @return Session[]
     */
    public function getAll() : array{
        return $this->sessions;
    }
}