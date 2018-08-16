<?php

declare(strict_types = 1);

namespace form;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use jojoe77777\FormAPI\FormAPI;
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase{

    const BUTTON_1 = 0;
    const BUTTON_2 = 1;

    /** @var FormAPI */
    private $api;

    protected function onEnable(): void{
        $this->api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    }

    /**
     * @return FormAPI
     */
    private function getFormAPI(): FormAPI{
        return $this->api;
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        if ($command->getName() === "test"){
            $this->createForm()->sendToPlayer($sender);
            return true;
        }
        return false;
    }

    /**
     * @return SimpleForm
     */
    private function createForm(): SimpleForm{
        $form = $this->getFormAPI()->createSimpleForm(function (Player $player, int $result = null){
            if ($result === null) return; // close form
            switch ($result){
                case self::BUTTON_1:
                    return;
                case self::BUTTON_2:
                    return;
            }
        });

        $form->setTitle("test");
        $form->setContent("sample");
        $form->addButton("Button1");
        $form->addButton("Button2");
        return $form;
    }
}
