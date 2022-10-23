<?php

/**
 * Copyright (C) 2018-2022  VennV
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace vennv\vclearchat;

use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener {

    private static array $chats = [];
    
    public function onEnable() : void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    /**
     * @param PlayerChatEvent $event
     * 
     * @return void
     */
    public function onPlayerChat(PlayerChatEvent $event) : void {
        $message = $event->getMessage();
        if (count(self::$chats) >= $this->getConfig()->get("chats_handler")) {
            for ($i = 0; $i < $this->getConfig()->get("chats_handler"); $i++) {
                $this->getServer()->broadcastMessage(TextFormat::RESET . '');
            }
            self::$chats = [];
        }
        self::$chats[] = $message;
    }
}