<?php

namespace Heal;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "Enable");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "Disable");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "heal":
                if ($sender->hasPermission("heal.command")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
    public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
            $sender->setHealth(20);
            $sender->addTitle("Healed", "Your HP is Full")
            $sender->sendMessage("§aYou have been healed!");
                break;
                    
                case 1:
                break;
            }
            
            
            });
            $form->setTitle("§lHeal Menu");
            $form->addButton("§lHeal");
            $form->addButton("§lExit");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
