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

Configure the Backend for the e.g. systemLogger and securityLogger:

```
TYPO3:
  Flow:
    log:
      systemLogger:
        backend: CRON\Flow\Log\Backend\SyslogBackend
        backendOptions:
          # identifies the application
          name: 'my-awesome-flow-app'
          # log all 
          severityThreshold: '%LOG_DEBUG%'
          # syslog facility code, default is LOG_LOCAL1
          facility: '%LOG_LOCAL3%'
      securityLogger:
        backend: CRON\Flow\Log\Backend\SyslogBackend
        backendOptions:
          # identifies the application
          name: 'my-awesome-flow-app'
          severityThreshold: '%LOG_DEBUG%'
          facility: '%LOG_LOCAL3%'
```


### Syslog Severity Levels

Value | Code        | Description
------|-------------|-----------------------------------------
0     | LOG_EMERG   | system is unusable
1     | LOG_ALERT   | action must be taken immediately
2     | LOG_CRIT    | critical conditions
3     | LOG_ERR     | error conditions
4     | LOG_WARNING | warning conditions
5     | LOG_NOTICE  | normal, but significant, condition
6     | LOG_INFO    | informational message
7     | LOG_DEBUG   | debug-level message

I do recommend to disable the severityThreshold, setting it to `LOG_DEBUG` and setup syslog for the
filtering/routing.


References
----------

* https://en.wikipedia.org/wiki/Syslog


License
-------

MIT