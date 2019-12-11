<?php

namespace Kad\SignPrefix;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\{Server, Player};
use pocketmine\math\Vector3;
use pocketmine\tile\Sign;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

class SignPrefix extends PluginBase implements Listener{

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onInteract(PlayerInteractEvent $event){
        if($event->getBlock()->getID() == 323 || $event->getBlock()->getID() == 63 || $event->getBlock()->getID() == 68){
            $sign = $event->getPlayer()->getLevel()->getTile($event->getBlock());
            if(!($sign instanceof Sign)){
                return;
            }
            $sign = $sign->getText();
            if($sign[0]=='[RANK]'){
                if(empty($sign[1]) !== true){
                    $prefix = $sign[1];
                    $pc = $this->getServer()->getPluginManager()->getPlugin("PureChat");
                    $player = $event->getPlayer();
                    $pc->setPrefix($prefix, $player);
                    $event->getPlayer()->sendMessage("Your Prefix has been set to " . $prefix);
                 }else{
                    $event->getPlayer()->sendMessage("An error has occurred.");
                 }
             }
        }
    }
}
     
