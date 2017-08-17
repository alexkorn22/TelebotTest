<?php


namespace app;


class Chat {

    public $id;
    public $idChat;
    public $curCommands;
    public $nextCommands;
    public $dataDoc = [];

    public function __construct($idChat){
        $this->idChat = $idChat;
    }

    public static function getOne($idChat) {
        $file = WWW . '/tmp/chats/' . md5($idChat) . '.json';
        if (file_exists($file)) {
            return unserialize(file_get_contents($file));
        };
        return new Chat($idChat);
    }

    public function getNextCommand() {

    }

    public function save() {
        $file = WWW . '/tmp/chats/' . md5($this->idChat) . '.json';
        if (file_put_contents($file, serialize($this))) {
            return true;
        } else {
            return false;
        }
    }
}