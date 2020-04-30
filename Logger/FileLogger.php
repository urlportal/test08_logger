<?php

namespace Logger;

use Logger\Observer\Observer;

class FileLogger extends AbstractLogger implements Observer
{
    public $filename;

    public function __construct(array $conf)
    {
        parent::__construct($conf);
        $this->filename = $conf['filename'];
    }

    public function log(int $level, string $message)
    {
        if ($this->isEnabled === true) {
            $fp = fopen($this->filename, "a");
            fwrite($fp, $this->getMessage($level, $message).PHP_EOL);
            fclose($fp);
        }
    }

    public function update(int $level, string $message)
    {
        $this->log($level, $message);
    }
}