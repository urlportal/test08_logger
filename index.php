<?php

/**
 * Компонент для логирования
 */
$logger = new Logger\Logger();

/**
 * Логер который все логи будет писать в файл application.log
 */
$fileLogger = new Logger\FileLogger(
    [
        'is_enabled' => true,
        'filename' => __DIR__ . '/application.log',
    ]
);

$logger->addLogger($fileLogger);

/**
 * Логер который все ошибки будет писать в файл application.error.log
 */
$logger->addLogger(
    new Logger\FileLogger(
        [
            'is_enabled' => true,
            'filename' => __DIR__ . '/application.error.log',
            'levels' => [
                Logger\LogLevel::LEVEL_ERROR,
            ],
        ]
    )
);

/**
 * Логгер который все информационные логи будет писать в файл application.info.log
 */
$logger->addLogger(
    new Logger\FileLogger(
        [
            'is_enabled' => true,
            'filename' => __DIR__ . '/application.info.log',
            'levels' => [
                Logger\LogLevel::LEVEL_INFO,
            ],
        ]
    )
);

/**
 * Логгер который все debug логи записывает в syslog
 *
 * @see http://php.net/manual/ru/function.syslog.php
 */
$logger->addLogger(
    new Logger\SyslogLogger(
        [
            'is_enabled' => true,
            'levels' => [
                Logger\LogLevel::LEVEL_DEBUG,
            ],
        ]
    )
);

/**
 * Логгер который ничего не делает
 */
$logger->addLogger(
    new Logger\FakeLogger()
);

/**
 * Логирование
 */

$logger->log(Logger\LogLevel::LEVEL_ERROR, 'Error message');
$logger->error('Error message');

$logger->log(Logger\LogLevel::LEVEL_INFO, 'Info message');
$logger->info('Info message');

$logger->log(Logger\LogLevel::LEVEL_DEBUG, 'Debug message');
$logger->debug('Debug message');

$logger->log(Logger\LogLevel::LEVEL_NOTICE, 'Notice message');
$logger->notice('Notice message');


$fileLogger->log(Logger\LogLevel::LEVEL_INFO, 'Info message from FileLogger');
$fileLogger->info('Info message from FileLogger');

$fileLogger->setIsEnabled(false);

$fileLogger->log(Logger\LogLevel::LEVEL_INFO, 'Info message from FileLogger');
$fileLogger->info('Info message from FileLogger');