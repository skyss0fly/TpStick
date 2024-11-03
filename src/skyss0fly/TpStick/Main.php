<?php

namespace skyss0fly\TpStick;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\entity\ItemSpawnEvent;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "tpstick") {
            if ($sender instanceof Player) {
              if ($sender hasPermission("TpStick.command")  {
                $stick = Item::get(Item::STICK);
                $stick->setCustomName("Teleporter Stick");
                $sender->getInventory()->addItem($stick);
                $sender->sendMessage("You have received a Teleporter Stick!");
            } else {
                $sender->sendMessage("This command can only be used in-game.");
            }
        }
        else {
$sender->sendMessage("You do not Have Permission to Use this Command");
        }
            return true;
        }
        return false;
    }

    /**
     * @param PlayerInteractEvent $event
     */
    public function onPlayerInteract(PlayerInteractEvent $event): void {
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();

        // Check if the player is holding the Teleporter Stick
        if ($item->getId() === Item::STICK && $item->getCustomName() === "Teleporter Stick") {
          if ($player hasPermission("TpStick.use"){
            $targetPosition = $event->getPosition(); // Get the clicked position
            $player->teleport($targetPosition); // Teleport the player to that position
            $player->sendMessage("Teleported to " . $targetPosition->getX() . ", " . $targetPosition->getY() . ", " . $targetPosition->getZ());
            $event->setCancelled(); // Prevent further actions if needed
        }
        else {
$player->sendMessage("You Don't have Permission to use this!");
        }
    }

    }
}
