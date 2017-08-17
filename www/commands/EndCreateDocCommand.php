<?php

namespace commands;

use core\App;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Update;

/**
 * Class TestCommand.
 */
class EndCreateDocCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'endCreateDoc';

    /**
     * @var string Command Description
     */
    protected $description = '';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments) {

        $keyboard = [
            [
                ['text' => 'Создать'],
                ['text' => 'Отмена'],
            ],
        ];

        $reply_markup = $this->telegram->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        $text =  'Вы действительно хотите создать документ?';
        $this->replyWithMessage(['text' => $text,
            'reply_markup' => $reply_markup]);
    }
}
