# read config

fs = require 'fs'
Q = require 'q' # @link https://github.com/kriskowal/q/

module.exports = self =

  dataPromise: null # cache

  get: (paramName) ->
    # read a config-file if not in cache
    if not self.dataPromise
      configFileName = if process.argv[2]? then process.argv[2] else './config.json'
      readFile = Q.denodeify(fs.readFile)
      self.dataPromise = readFile(configFileName).then (data) ->
        JSON.parse(data)

    # get data from cache
    self.dataPromise.then (data) ->
      if paramName
        data[paramName] # required property
      else
        data # all data
