config = require './config'
logger = require './logger'
socketWrapper = require './socketWrapper'

# catch errors
process.on 'uncaughtException', (err) ->
  logger.log(logger.logLevelEmergency, 'uncaughtException', err)


# read config
config.get().then((configJson) ->

# logger
  logger.logLevel = configJson.logLevel
  socketWrapper.logger = logger


  # connect to the socket-port and listen it
  socketWrapper.secretKey = configJson.secretKey
  socketWrapper.init(configJson.port)
).done()
