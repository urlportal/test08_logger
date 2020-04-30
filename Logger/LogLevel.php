<?php

namespace Logger;

use Exception;

class LogLevel
{
    const LEVEL_ERROR  = 1;
    const LEVEL_INFO   = 2;
    const LEVEL_DEBUG  = 3;
    const LEVEL_NOTICE = 4;
    const LIST = [
        '1' => 'ERROR',
        '2' => 'INFO',
        '3' => 'DEBUG',
        '4' => 'NOTICE',
    ];

    public static function getLogLevelName(int $id)
    {
        try{
            if (!empty(self::LIST[$id])){
                return self::LIST[$id];
            } else {
                throw new Exception("Получен ID не существующего уровня логирования. Проверьте константы класса LogLevel");
            }
        } catch (Exception $e) {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL);
        }
    }
}