<?php


namespace core;


use app\Chat;
use app\Commands;
use commands\CreateDocCommand;
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
    /**
     * @var Chat
     */
    public static $curChat;

    public static function Init($config) {
        App::$debug = new Debug();
        App::$commands = new Commands();
        App::$telegram = new Api($config['token']);
    }

    public static function run() {
        App::$commands->getCommands();
        App::$commands->checkUpdates();
    }

}