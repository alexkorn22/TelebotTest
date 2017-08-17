<?php

namespace app;

use commands\CreateDocCommand;

use core\App;
use Telegram\Bot\Objects\Update;

class Commands {

    /**
     * @var \Telegram\Bot\Api
     */
    protected $telegram;

    public function getCommands() {
        $commands = [
            'StartCommand',
            'CreateDocCommand',
            'CreateDocRCommand',
            'ConsumptionCommand',
            'EndCreateDocCommand',
        ];
        foreach ($commands as $command) {
            $class = '\\commands\\' . $command;
            $item =  new $class();
            App::$telegram->addCommand($item);
        }
    }

    public function checkUpdates() {
        $updates = App::$telegram->getUpdates();
        $highestId = -1;

        foreach ($updates as $update) {
            $highestId = $update->getUpdateId();
            App::$curChat = Chat::getOne($update->getMessage()->getChat()->getId());
            $this->checkUpdate($update);
            App::$curChat->save();
        }

        if ($highestId != -1) {
            $params = [];
            $params['offset'] = $highestId + 1;
            $params['limit'] = 1;
            App::$telegram->getUpdates($params);
        }
    }

    protected function checkUpdate(Update $update) {


        if (!empty(App::$curChat->nextCommands)) {

            $message = $update->getMessage();
            if ($message !== null && $message->has('text')) {
                App::$telegram->getCommandBus()->execute(App::$curChat->nextCommands, $message->getText(), $update);
            }
        } else {
            App::$telegram->processCommand($update);
        }


    }

}