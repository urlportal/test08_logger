<?php

namespace Logger\Observer;

interface Observer
{
    public function update(int $level, string $message);
}