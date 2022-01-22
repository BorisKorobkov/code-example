# Socket-server

This websocket-server is written in Node.JS / CoffeeScript and used engine http://socket.io/ .
It works like a daemon: always is running, listen a port, receive socket-requests, push data back to sockets.

## Install

1. Install applications: `npm install:ubuntu` or `npm install:centos` (with `sudo`).
2. Install dependencies: `npm install`.
3. (optional) Create a self-signed HTTPS-certificate: `npm install:create_cert`. 
   Or copy real HTTPS-certificate to `ssl/cert.crt` and `ssl/cert.key`.
   When files `ssl/cert.crt` and `ssl/cert.key` exist - HTTPS protocol is used. Otherwise - HTTP.
5. (optional) Install JS- or PHP- client. See details in `php_yii_plugin`.

## Config

1. Create a config-file and edi it: `cp config.tpl.json config.json; nano config.json`
2. (optional) Set the same domain, port and secretKey to the client. See details in `php_yii_plugin`.

## Run

* Dev: `node index`. To stop press "Ctrl+C".
* Prod: `npm run`. To stop enter `npm stop`

## Integration test

* `npm test`.
  * Connection error - socket-server doesn't work. 
  * "clientsCount" - socket-server works. The number is a number of clients.
