### Задача
Написать компонент для логирования требующийся для запуска данного файла /index.php (то, что внутри него менять нельзя).
Компонент должен поддерживать разные способы логирования (роуты):
логирование в файл (FileLogger), логирование в syslog (SysLogger),
логгер который ничего не делает (FakeLogger).

Результатом выполнение программы должно быть:
- 2 записи в syslog (не обязательно, главное реализовать логгер)
- 3 файла

Файл application.log
```
2016-05-30T09:50:57+00:00  001  ERROR  Error message
2016-05-30T09:50:57+00:00  001  ERROR  Error message
2016-05-30T09:50:57+00:00  002  INFO  Info message
2016-05-30T09:50:57+00:00  002  INFO  Info message
2016-05-30T09:50:57+00:00  003  DEBUG  Debug message
2016-05-30T09:50:57+00:00  003  DEBUG  Debug message
2016-05-30T09:50:57+00:00  004  NOTICE  Notice message
2016-05-30T09:50:57+00:00  004  NOTICE  Notice message
2016-05-30T09:50:57+00:00  002  INFO  Info message from FileLogger
2016-05-30T09:50:57+00:00  002  INFO  Info message from FileLogger
```

Файл application.error.log  
```
2016-05-30T09:50:57+00:00  001  ERROR  Error message
2016-05-30T09:50:57+00:00  001  ERROR  Error message
```

Файл application.info.log
```
2016-05-30T09:50:57+00:00  002  INFO  Info message
2016-05-30T09:50:57+00:00  002  INFO  Info message
```

Формат записи в файл:
```
{дата} {код уровня логирования} {уровень логирования} {сообщение}
```