Flow Syslog Backend
===================

Abstract
--------

This Flow package allows you to use the local syslog daemon for logging and is a replacement for the
`TYPO3\Flow\Log\Backend\FileBackend`.

This is especially useful while integrating external services for log-management, like e.g.
[Papertrail](https://papertrailapp.com), which are using the syslog protocol for (securely) access. 


Install
-------

```
composer require cron-eu/flow-syslog:dev-master --update-no-dev
```


Setup
-----

Configure this Backend for the e.g. systemLogger:

```
TYPO3:
  Flow:
    log:
      systemLogger:
        backend: CRON\Flow\Log\Backend\SyslogBackend
        backendOptions:
          # identifies the application
          name: 'my-awesome-flow-app'
          # syslog facility code, defaults to 17 (LOG_LOCAL1)
          # see https://en.wikipedia.org/wiki/Syslog
          facility: 17 
```

This Backend can be used for other Flow loggers, like `securityLogger`, `sqlLogger`, ...


License
-------

MIT