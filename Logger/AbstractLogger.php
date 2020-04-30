<?php

namespace Logger;

abstract class AbstractLogger
{
    public $isEnabled;
    public $levels;
    public $id = null;

    public function __construct($conf = null)
    {
        try {
            $this->isEnabled = ConfigParamHandler::handleIsEnabled($conf);
            $this->levels = ConfigParamHandler::handleLevels($conf);
        } catch (\Throwable $e) {
            echo "<p>Исключение!<br>
                  Сообщение: " . $e->getMessage() . "<br>
                  Файл: " . $e->getFile() . "<br>
                  Строка: " . $e->getLine() . "</p>";
        }
    }

    abstract public function log(int $level, string $message);

    public function error(string $message)
    {
        $level = LogLevel::LEVEL_ERROR;
        $this->log($level, $message);
    }

    public function info(string $message)
    {
        $level = LogLevel::LEVEL_INFO;
        $this->log($level, $message);
    }

    public function debug(string $message)
    {
        $level = LogLevel::LEVEL_DEBUG;
        $this->log($level, $message);
    }

    public function notice(string $message)
    {
        $level = LogLevel::LEVEL_NOTICE;
        $this->log($level, $message);
    }

    public function setIsEnabled(bool $val){
        $this->isEnabled = $val;
    }

    public function getMessage(int $level, string $message)
    {
        return date("c").'  '.sprintf("%03d", $level).'  '.LogLevel::getLogLevelName($level).'  '.$message;
    }
}