<?php


namespace core;


use app\Commands;
use commands\StartCommand;
use Telegram\Bot\Api;

class App{

    /**
     * @var Debug
     */
    public static $debug;
    /**
     * @var Commands
     */
    public static $commands;
    /**
     * @var Api
     */
    public static $telegram;

    public static function Init($config) {
        App::$debug = new Debug();
        App::$commands = new Commands();
        App::$telegram = new Api($config['token']);
    }

    public static function run() {
        $command = new StartCommand();
        App::$telegram->addCommand($command);

        $updates = App::$telegram->getUpdates();
        $highestId = -1;

        foreach ($updates as $update) {
            $highestId = $update->getUpdateId();
            App::$telegram->processCommand($update);
        }

        if ($highestId != -1) {
            $params = [];
            $params['offset'] = $highestId + 1;
            $params['limit'] = 1;
            App::$telegram->getUpdates($params);
        }
    }

}