<?php

namespace commands;

use core\App;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Objects\Update;

/**
 * Class TestCommand.
 */
class ConsumptionCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'consumption';

    /**
     * @var string Command Description
     */
    protected $description = 'Test command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments) {
        App::$curChat->nextCommands = 'endCreateDoc';
        $this->replyWithMessage(['text' => 'Введите сумму']);
    }
}
