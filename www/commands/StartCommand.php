<?php

namespace commands;

use core\App;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Update;

/**
 * Class TestCommand.
 */
class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $commands = $this->telegram->getCommands();

        $text = '';
        foreach ($commands as $name => $handler) {
            $text .= sprintf( $handler->getDescription());
        }

        $keyboard = [
            [
                ['text' => 'start'],
                ['text' => 'Создать документ']
            ],
        ];

        $reply_markup = $this->telegram->replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false
        ]);
        $this->replyWithMessage(['text' => 'Выберите действие',
            'reply_markup' => $reply_markup]);
    }
}
