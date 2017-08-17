<?php
function checkCommands(&$text, &$matches) {
    if (!empty($matches)) {
        return;
    }
    $matches = [$text,$text,'',''];
}