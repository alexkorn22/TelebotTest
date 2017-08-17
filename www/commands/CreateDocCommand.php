<?php

namespace commands;

use core\App;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Update;

/**
 * Class TestCommand.
 */
class CreateDocCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'Создать документ';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $keyboard = [
            [
                ['text' => 'start'],
                ['text' => 'Документ РН'],
                ['text' => 'Документ ПН'],
            ],
        ];

        $reply_markup = $this->telegram->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
        $this->replyWithMessage(['text' => 'Выберите документ, который нужно создать',
            'reply_markup' => $reply_markup]);
    }
}
