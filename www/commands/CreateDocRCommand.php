<?php

namespace commands;

use core\App;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Update;

/**
 * Class TestCommand.
 */
class CreateDocRCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'Документ РН';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments) {
        App::$curChat->nextCommands = "consumption";
        App::$curChat->dataDoc['type'] = "Документ РН";
        $keyboard = [
            [
                ['text' => 'Аренда'],
                ['text' => 'Электричество'],
                ['text' => 'Телефон'],
            ],
            [
                ['text' => 'Интернет'],
                ['text' => 'Прочее'],
                ['text' => 'Отмена'],
            ]
        ];
        $reply_markup = $this->telegram->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);
        $this->replyWithMessage(['text' => 'Выберите статью расходов',
            'reply_markup' => $reply_markup]);
    }
}
