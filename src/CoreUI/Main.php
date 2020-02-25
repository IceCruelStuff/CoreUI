<?php
/*
  _____ _          ____            _    _    _           
 |_   _| |__   ___|  _ \ ___  __ _| |  / \  | | _____  __
   | | | '_ \ / _ \ |_) / _ \/ _` | | / _ \ | |/ _ \ \/ /
   | | | | | |  __/  _ <  __/ (_| | |/ ___ \| |  __/>  < 
   |_| |_| |_|\___|_| \_\___|\__,_|_/_/   \_\_|\___/_/\_\
                                                         
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
            $sender->sendMessage(TextFormat::YELLOW . "Enabled flight mode!");
            $sender->setAllowFlight(true);
                break;
                case 1:
            $sender->sendMessage(TextFormat::YELLOW . "Disabled flight mode!");
            $sender->setAllowFlight(false);
                break;				
                case 2:
            $sender->setHealth(20);
            $sender->sendMessage(TextFormat::YELLOW . "Your has ben Healed");
                break;  
                case 3:
            $sender->setFood(20);
            $sender->sendMessage(TextFormat::YELLOW . "You have been feed!");
                break;  
                case 4:
            $sender->setGameMode(1);
            $sender->sendMessage(TextFormat::YELLOW . "GameMode changed to §9Creative");
                break;
                case 5:
            $sender->setGameMode(2);
            $sender->sendMessage(TextFormat::YELLOW . "GameMode changed to §9Adventure");
                break;
                case 6:
            $sender->setGameMode(3);
            $sender->sendMessage(TextFormat::YELLOW . "GameMode changed to §9Spectator");
                break;			
		case 7:
            $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 99999999, 0, false));
            $sender->addTitle(TextFormat::YELLOW . "Vanish Enabled");
                break;		    
		case 8:
            $sender->removeEffect(Effect::INVISIBILITY);
            $sender->addTitle(TextFormat::YELLOW . "Vanish Enabled");
		break;	    
		case 9:
            $command = "pl" ;
            $this->getServer()->getCommandMap()->dispatch($sender, $command);
		break;	     
                case 10:
            $sender->addTitle(TextFormat::YELLOW . "CoreUI Closed");
                break;				
            }
            
            
            });
            $form->setTitle("§7-= §l§eCoreUI§r §7=-");
			$form->setContent("§o§7MiniCoreUI By AlexItz16");
                        $form->addButton("§l§eFly on\n§r§o§7Tap for Activate Fly");
			$form->addButton("§l§eFly off\n§r§o§7Tap for Disable Fly");
			$form->addButton("§l§6Heal\n§r§o§7Tap for Heal");
			$form->addButton("§l§6Feed\n§r§o§7Tap for Eat");
			$form->addButton("§l§bCreative\n§r§o§7Tap to change GM");
			$form->addButton("§l§bAdventure\n§r§o§7Tap to change GM");
			$form->addButton("§l§bSpectator\n§r§o§7Tap to change GM");
	     		$form->addButton("§l§bVanish on\n§r§o§7press for Activate Vanish");
	    		$form->addButton("§l§bVanish off\n§r§o§7Press for Disable Vanish");
	    		$form->addButton("§l§5Plugins\n§r§o§7Show Server plugins");
			
            $form->addButton("§l§6CLOSE");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
