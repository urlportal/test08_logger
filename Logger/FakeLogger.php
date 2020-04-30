<?php

namespace Logger;

use Logger\Observer\Observer;

class FakeLogger extends AbstractLogger implements Observer
{

    public function log(int $level, string $message)
    {
        if ($this->isEnabled === true) {
            // Ничего не делаем
        }

    }

    public function update(int $level, string $message)
    {
        $this->log($level, $message);
    }

}