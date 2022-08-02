# work with socket.io http://socket.io/ https://github.com/socketio/socket.io/tree/master/docs
#
# socket.emit('message', 'this is a test') - send to sender
# socket.broadcast.emit('message', 'this is a test') - send to everyone except the sender
# io.sockets.emit('message', 'this is a test') - send to everyone, including the sender
#
# socket.broadcast.to('game').emit('message', 'cool game') - send to everyone in the channel except the sender
# io.sockets.in('game').emit('message', 'cool game') - send to everyone in the channel, including the sender
#
# io.sockets.socket(socketid).emit('message', 'for your eyes only') - send to socketid

fs = require('fs')
express = require('express')()

if fs.existsSync('ssl/cert.key') and fs.existsSync('ssl/cert.crt')
# https
  options =
    key: fs.readFileSync('ssl/cert.key'),
    cert: fs.readFileSync('ssl/cert.crt')
  server = require('https').Server(options, express)
else
# http
  server = require('http').Server(express)

io = require('socket.io').listen(server)
crypto = require('crypto')

module.exports = self =

# logger
  logger: null

# signature password
  secretKey: ''

# socket to user: socketId => handshakeData
  socketsData: {}

# handshake (check signature)
# check GET-params: md5(param1=paramValue1param2=paramValue2secretKey) = sig
  handshake: (socket) ->
    required = ['user', 'userId', 'sig']
    handshakeData = socket.request._query
    strToHash = ''
    for paramName in required

      if !handshakeData[paramName]
        self.logger.log(self.logger.logLevelError, 'ParamName is not set ' + paramName)
        return false

      if paramName == 'sig'
        continue

      strToHash += paramName + '=' + handshakeData[paramName]

    strToHash += self.secretKey
    sig = handshakeData['sig']
    hash = crypto.createHash('md5').update(strToHash).digest('hex')

    isOk = hash == sig
    if isOk
      self.logger.log(self.logger.logLevelDebug, {str: strToHash, hash: hash, sig: sig})
    else
      self.logger.log(self.logger.logLevelInfo, {str: strToHash, hash: hash, sig: sig})
    isOk

# remember socket and user
  setUserBySocket: (socket, data) ->
    if data
      self.socketsData[socket.id] = data
    else
      delete self.socketsData[socket.id]

# get user by socket
  getUserBySocket: (socket) ->
    socketId = (socket.id).toString()
    self.socketsData[socketId]

# get sockets by user
  getSocketsByUser: (user) ->
    sockets = []
    for socketId, socketData of self.socketsData
      if socketData['user'].toString() == user.toString()
        sockets.push(io.sockets.sockets[socketId])
    sockets

# get sockets by userId
  getSocketsByUserId: (userId) ->
    sockets = []
    for socketId, socketData of self.socketsData
      if socketData['userId'].toString() == userId.toString()
        sockets.push(io.sockets.sockets[socketId])
    sockets

# init
  init: (port) ->
# listen a port
    server.listen port, ->
# after connect
      self.logger.log(self.logger.logLevelNotice, 'Listening on port ' + port)

    express.get '/', (request, response) ->
# root request
# return statistic
      statString = JSON.stringify
        clientsCount: io.engine.clientsCount,
#        clients: Object.keys(io.engine.clients),
        socketsData: self.socketsData
      response.writeHead(200, {'Content-Type': 'application/json'})
      response.write(statString)
      response.end()

    # handshake (check signature)
    io.use (socket, next) ->
      handshakeData = socket.request._query
      if self.handshake(socket)
        self.logger.log(self.logger.logLevelDebug, 'Handshake ' + handshakeData['user'] + ' ' + socket.id)
        self.setUserBySocket(socket, handshakeData) # remember socket and user
        next()
      else
        self.logger.log(self.logger.logLevelError, 'Handshake error ' + socket.id, handshakeData)
        next(new Error('not authorized')) # wrong request

    io.on 'connection', (socket) ->
# on connect new user
      user = self.getUserBySocket(socket)['user']
      userId = self.getUserBySocket(socket)['userId']
      self.logger.log(self.logger.logLevelInfo, 'Connected ' + user + ' ' + socket.id)

      socket.on 'message', (params) ->
# on receive a message from a user
        if params instanceof String
# convert a string to an object
          params =
            message: params
        params['userFrom'] = user
        params['userIdFrom'] = userId
        params['socketIdFrom'] = socket.id

        if params['userTo'] or params['userIdTo']
# send to the exact user
          if params['userIdTo']
            tmpSockets = self.getSocketsByUserId(params['userIdTo'])
          else
            tmpSockets = self.getSocketsByUser(params['userTo'])

          if tmpSockets.length == 0
            self.logger.log(self.logger.logLevelNotice, 'Message. User not found', params)
            return

          self.logger.log(self.logger.logLevelInfo, 'Message.user', params)
          for i, tmpSocket of tmpSockets
            tmpSocket.emit('message', params)
          return

        # send to everybody
        self.logger.log(self.logger.logLevelInfo, 'Message', params)
        io.emit('message', params)

      socket.on 'disconnect', () ->
# on disconnect
        self.logger.log(self.logger.logLevelInfo, 'Disconnected ' + user + ' ' + socket.id)
        self.setUserBySocket(socket, null) # сбросить данные юзера для сокета
