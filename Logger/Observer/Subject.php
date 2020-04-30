<?php

namespace Logger\Observer;

interface Subject
{
    public function addLogger (Observer $observer);

    public function detachLogger (Observer $observer);

    public function notify (int $level, string $message);
}