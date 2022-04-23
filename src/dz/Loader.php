<?php

namespace dz;

use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase
{
  public function onEnable(): void
  {
    $this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);
    $this->saveResource("config.yml");
    $this->getServer()->info("plugin CustomJoinMessage has enable");
  }
  /**
   * @param PlayerJoinEvent $event
   */
  public function onJoin(\pocketmine\event\player\PlayerJoinEvent $event)
  {
    $p = $event->getPlayer();
    $event->setJoinMessage($this->convertString($this->config->get("join-message"), $p));
  }
  
  /**
   * @param String $string
   * @param Player $p
   * @return void
   */
  public function convertString(string $string, Player $p)
  {
    $string = str_replace("{player}", $p->getName(), $string);
    return $string;
  }
}
?>
