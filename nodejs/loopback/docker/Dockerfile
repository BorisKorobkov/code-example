# https://hub.docker.com/_/node
FROM node:current-alpine as node_base
WORKDIR /home/node
EXPOSE 3000
RUN npm install -g npm@8.18.0


FROM node_base as node_loopback
# https://loopback.io/getting-started.html
RUN npm install -g @loopback/cli


FROM node_loopback as node_loopback_prod
COPY ./ /home/node/
