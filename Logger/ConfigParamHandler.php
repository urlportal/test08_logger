<?php

namespace Logger;

class ConfigParamHandler
{
    static function handleIsEnabled($conf)
    {
        $default_value = true;

        /**
         * 1. Если параметр отсутствует, возвращаем $default_value
         * 2. Булев тип проходит и возвращается
         * 3. Пустота или другие значения порождают исключение
         */
        if ($conf) {
            if (!isset($conf['is_enabled'])) {
                return $default_value;
            } else {
                if (is_bool($conf['is_enabled'])) {
                    return $conf['is_enabled'];
                } else {
                    throw new \InvalidArgumentException("Параметр 'is_enabled' должен иметь булев тип. Можете вообще убрать этот параметр или прислать пустую строку, чтобы установилось значение по-умолчанию = true.");
                }
            }
        } else {
            return $default_value;
        }
    }

    static function handleLevels($conf)
    {
        $res = [];

        if ($conf){
            if (!isset($conf['levels']) || $conf['levels'] === null || empty($conf['levels'])) {
                foreach (self::getLogLevelList() as $key => $item) {
                    $res[] = $key;
                }
            } else {
                foreach ($conf['levels'] as $item) {
                    if (isset(self::getLogLevelList()[$item])){
                        $res[] = $item;
                    } else {
                        throw new \InvalidArgumentException("Получен ID не существующего уровня логирования. Проверьте константы класса LogLevel");
                    }
                }
            }
        } else {
            foreach (self::getLogLevelList() as $key => $item) {
                $res[] = $key;
            }
        }

        return $res;
    }

    private static function getLogLevelList(): array
    {
        return LogLevel::LIST;
    }
}