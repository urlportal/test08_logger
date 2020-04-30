<?php

namespace Logger;

use Logger\Observer\Observer;

class SyslogLogger extends AbstractLogger implements Observer
{

    public function log(int $level, string $message)
    {
        syslog($this->getSyslogPriorityName($level), $this->getMessage($level, $message));
    }

    public function update(int $level, string $message)
    {
        $this->log($level, $message);
    }

    private function getSyslogPriorityName(int $level)
    {
        switch (LogLevel::LIST[$level]){
            case('ERROR'):
                return 3;
                break;
            case('INFO'):
                return 6;
                break;
            case('DEBUG'):
                return 7;
                break;
            case('NOTICE'):
                return 5;
                break;
        }
    }

}