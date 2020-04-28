<?php
/*
  ____        ____            _    _                     
 |  _ \  __ _|  _ \ ___  __ _| |  / \   __ _ _   _  __ _ 
 | | | |/ _` | |_) / _ \/ _` | | / _ \ / _` | | | |/ _` |
 | |_| | (_| |  _ <  __/ (_| | |/ ___ \ (_| | |_| | (_| |
 |____/ \__,_|_| \_\___|\__,_|_/_/   \_\__, |\__,_|\__,_|
                                          |_|            
*/
namespace CoreUI;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class Main extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "CoreUI Enable");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "CoreUI Disable");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "coreui":
                if ($sender->hasPermission("coreui.command")){
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
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "Enabled flight mode!");
            $sender->setAllowFlight(true);
                break;
                case 1:
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "Disabled flight mode!");
            $sender->setAllowFlight(false);
                break;				
                case 2:
            $sender->setHealth(20);
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "Your has ben Healed");
                break;  
                case 3:
            $sender->setFood(20);
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "You have been feed!");
                break;  
                case 4:
            $sender->setGameMode(1);
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "GameMode changed to §9Creative");
                break;
                case 5:
            $sender->setGameMode(2);
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "GameMode changed to §9Adventure");
                break;
                case 6:
            $sender->setGameMode(3);
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "GameMode changed to §9Spectator");
                break;			
		case 7:
            $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 99999999, 0, false));
            $sender->addTitle(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "Vanish Enabled");
                break;		    
		case 8:
            $sender->removeEffect(Effect::INVISIBILITY);
            $sender->addTitle(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "Vanish Disabled");
		break;	    
		case 9:
            $command = "pl" ;
            $this->getServer()->getCommandMap()->dispatch($sender, $command);
		break;	     
                case 10:
            $sender->sendMessage(TextFormat::LIGHT_PURPLE."(CORE) ". TextFormat::YELLOW . "CoreUI Closed");
                break;				
            }
            
            
            });
            $form->setTitle(TextFormat::BOLD. TextFormat::LIGHT_PURPLE."CORE");
			$form->setContent(TextFormat::GRAY."Author: DaRealAqua\n".TextFormat::GRAY."Version: 0.0.2");
                        $form->addButton(TextFormat::GRAY."Enable Fly\n".TextFormat::LIGHT_PURPLE."Tap for Activate Fly");
			$form->addButton(TextFormat::GRAY."Dezactive Fly\n".TextFormat::LIGHT_PURPLE."Tap for Disable Fly");
			$form->addButton(TextFormat::GRAY."Heal\n".TextFormat::LIGHT_PURPLE."Tap for Heal");
			$form->addButton(TextFormat::GRAY."Feed\n".TextFormat::LIGHT_PURPLE."Tap for Eat");
			$form->addButton(TextFormat::GRAY."Creative\n".TextFormat::LIGHT_PURPLE."Tap to change GM");
			$form->addButton(TextFormat::GRAY."Adventure\n".TextFormat::LIGHT_PURPLE."Tap to change GM");
			$form->addButton(TextFormat::GRAY."Spectator\n".TextFormat::LIGHT_PURPLE."Tap to change GM");
	     		$form->addButton(TextFormat::GRAY."Vanish on\n".TextFormat::LIGHT_PURPLE."Press for Activate Vanish");
	    		$form->addButton(TextFormat::GRAY."Vanish off\n".TextFormat::LIGHT_PURPLE."Press for Disable Vanish");
	    		$form->addButton(TextFormat::GRAY."Plugins\n".TextFormat::LIGHT_PURPLE."Show Server plugins");
			
            $form->addButton(TextFormat::RED."Close");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
