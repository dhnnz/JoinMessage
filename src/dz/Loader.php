<?php

namespace dz;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase
{
  /**
   * onEnable():
   */
  public function onEnable(): void
  {
    $this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);
    $this->saveResource("config.yml");
    $this->getServer()->info("plugin CustomJoinMessage has enable");
  }
  /**
   * 
   * PlayerJoinEvent()
   * 
   */
  public function onJoin(\pocketmine\event\player\PlayerJoinEvent $event)
  {
    $p = $event->getPlayer();
    $event->setJoinMessage($this->convertString($this->config->get("join-message"), $p));
  }
  
  /**
   * convert to String
   * data Config
   */
  public function convertString(string $string, Player $p)
  {
    $string = str_replace("{player}", $p->getName(), $string);
    return $string;
  }
}
?>
