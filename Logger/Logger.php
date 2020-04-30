<?php

namespace Logger;

use Logger\Observer\Subject;
use Logger\Observer\Observer;

class Logger implements Subject
{
    /**
     * Контейнер зарегистрированных логеров (слушателей)
     * Представляет из себя массив объектов. После регистрации логера
     * внутри появляется следуующая структура:
     * [ID_уровня_логирования][ID_логера]{объект_логера}
     *
     * @var array
     */
    private $loggers = [];
    private $next_observer_id = 1;

    public function addLogger(Observer $observer)
    {
        $this->giveIdToNewObserver($observer);
        $this->addObserverToSubjectList($observer);
        $this->next_observer_id++;
    }

    public function detachLogger(Observer $observer)
    {
        foreach ($this->loggers as $log_level => $loggers) {
            unset($this->loggers[$log_level][$observer->id]);
        }
    }

    public function notify(int $level, string $message)
    {
        if($this->issetObserversWithLevel($level)){
            foreach ($this->loggers[$level] as $logger) {
                $logger->update($level, $message);
            }
        };
    }

    public function log(int $level, string $message)
    {
        $this->notify($level, $message);
    }

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

    private function issetObserversWithLevel(int $id)
    {
        return !empty($this->loggers[$id]);
    }

    private function giveIdToNewObserver(Observer $observer)
    {
        $observer->id = $this->next_observer_id;
    }

    private function addObserverToSubjectList(Observer $observer)
    {
        if ( ! is_null($observer->levels) ) {
            foreach ($observer->levels as $level) {
                $this->loggers[$level][$observer->id] = $observer;
            }
        } else {
            foreach (LogLevel::LIST as $id => $name){
                $this->loggers[$id][$observer->id] = $observer;
            }
        }
    }
}