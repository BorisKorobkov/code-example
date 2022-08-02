# write logs
module.exports = self =

# minimal level for logging
  logLevel: 250

# @link https://github.com/Seldaek/monolog/blob/master/src/Monolog/Logger.php
  logLevelDebug: 100
  logLevelInfo: 200
  logLevelNotice: 250
  logLevelWarning: 300
  logLevelError: 400
  logLevelCritical: 500
  logLevelAlert: 550
  logLevelEmergency: 600

  log: (logLevel) ->
    if self.logLevel and logLevel >= self.logLevel
      if logLevel >= self.logLevelWarning
        console.error(Date(), arguments)
      else
        console.log(Date(), arguments)
