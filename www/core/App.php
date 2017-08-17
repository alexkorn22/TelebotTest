<?php


namespace core;


class App{

    /**
     * @var Debug
     */
    public static $debug;

    public static function Init() {
        App::$debug = new Debug();
    }

}