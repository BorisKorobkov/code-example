# Intro

* What is LoopBack?
  * TypeScript / Node.js framework
* What activities does LoopBack help on?
  * Generate code from CLI, generate models from the DB
  * Create migrations from models, apply them
  * Use REST API "out of the box" (with a few lines of code)
  * OpenAPI, Swagger
* Explain [core concepts](https://loopback.io/doc/en/lb4/Concepts.html) of the framework
  * Controller - takes request parameters, calls Repository / Service.
  * Repository - takes data from Datasource, creates Model.
  * Datasource - how to get data from a storage (DB, file, external REST, etc.)
  * Model - data structure (fields, relations).

# Requirements

* Docker with Docker Compose V2.

[Docker Desktop](https://www.docker.com/get-started) already contain Docker and Docker Compose V2. You can install it on Windows, macOS, Linux.

* Required: version 3.4+. Switch to Compose V2 manually ("General", set checkbox "Use Docker Compose V2", save).
* Recommended: version 4.4.2+.

Alternatively, you can install Docker and Docker Compose for Linux without Docker Desktop. 

* Install pure Docker in Ubuntu:

```
sudo apt install docker.io
```

* Install pure Docker Compose in Ubuntu:

```
sudo mkdir -p /usr/local/lib/docker/cli-plugins
sudo curl -SL https://github.com/docker/compose/releases/download/v2.6.1/docker-compose-linux-x86_64 -o /usr/local/lib/docker/cli-plugins/docker-compose
sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose
```

* Docker Compose V1 probably works, but isn't tested and isn't supported. How to test:

```
docker compose version # It should be "Docker Compose version v2.6.1" or similar. If you see an error - see abobe how to install.
docker compose -v # It should be an error like "Usage: docker compose [OPTIONS] COMMAND". If you see corrent version message - it's Docker Compose V1. See above how to update it.
docker-compose -v # It should be an error like "Command not found". If you see corrent version message - you don't need "docker-compose" (with hyphen), you can purge it (but you can leave it also).
```

You don't need to install Node.js, npm, MySQL / PostgreSQL, etc. to your host machine. You can use everything in docker containers. 

# Install

Build docker image DEV

    docker build --tag boriskorobkov/loopback:dev -f docker/Dockerfile --target node_loopback ./node

Build docker image PROD

    docker build --tag boriskorobkov/loopback:dev -f docker/Dockerfile --target node_loopback_prod ./node

# Run
    
## Prod with installed Traefik

    docker compose --env-file docker/docker-compose.env -f docker/docker-compose.yml -f docker/docker-compose.traefik.yml --project-name loopback up

If you want to demonize, then add ` -d`

If you have Docker Swarm, then add ` -f docker/docker-compose.swarm.yml`

* App: [https://loopback.korobkov.su/](https://loopback.korobkov.su/)
* Adminer: [https://adminer-loopback.korobkov.su/](https://adminer-loopback.korobkov.su/?pgsql=postgres&username=boris&db=loopback&ns=public), password `korobkov`

## Local with exposed ports

    docker compose --env-file docker/docker-compose.env -f docker/docker-compose.yml -f docker/docker-compose.expose.yml  --project-name loopback up

* App: [http://localhost:3000/](http://localhost:3000/)
* Adminer: [http://localhost:8080/](http://localhost:8080/?pgsql=postgres&username=boris&db=loopback&ns=public), password `korobkov`

# Develop

When docker compose isn't running:

    docker run -it --volume=$PWD:/home/node --entrypoint /bin/sh boriskorobkov/loopback:dev

When docker compose is running:

    docker exec -it loopback-nodejs-1 /bin/sh

* [Application](https://loopback.io/doc/en/lb4/Application.html):
  [generator](https://loopback.io/doc/en/lb4/Application-generator.html).
  `lb4 app; cd PROJECT_NAME`

* [Model](https://loopback.io/doc/en/lb4/Model.html):
  [generator](https://loopback.io/doc/en/lb4/Model-generator.html),
  [from DB](https://loopback.io/doc/en/lb4/Discovering-models.html),
  [relation](https://loopback.io/doc/en/lb4/Relation-generator.html).
  `lb4 model`

* [Datasource](https://loopback.io/doc/en/lb4/DataSource.html):
  [generator](https://loopback.io/doc/en/lb4/DataSource-generator.html),
  [PostgreSQL](https://loopback.io/doc/en/lb4/PostgreSQL-connector.html).
  `lb4 datasource`

* [Repository](https://loopback.io/doc/en/lb4/Repository.html):
  [generator](https://loopback.io/doc/en/lb4/Repository-generator.html).
  `lb4 repository`

* [Controller](https://loopback.io/doc/en/lb4/Controller-generator.html).
  `lb4 controller`

* [CRUD controller](https://loopback.io/doc/en/lb4/Rest-Crud-generator.html).
  `lb4 rest-crud`

* [Service](https://loopback.io/doc/en/lb4/Service.html):
  [generator](https://loopback.io/doc/en/lb4/Service-generator.html).
  `lb4 service`

* [Migration](https://loopback.io/doc/en/lb4/Database-migrations.html).
  `npm run migrate`

# Debug

File | Settings | Build, Execution, Deployment | Docker | +

* "Name" = "Docker"
* "Unix socket" = "unix:///var/run/docker.sock" (Linux) or "http://127.0.0.1:2376" (Windows and Mac)

File | Settings | Plugins | Marketplace | Node.js Remote Interpreter  | Install

File | Settings | Languages & Frameworks | Node.js | Node interpreter | ... | + | Add Remote | Docker | boriskorobkov/loopback:dev | OK | OK | OK

In case of error "_Cannot connect to the Docker daemon at unix:///var/run/docker.sock. Is the docker daemon running?_" on Linux:

    sudo ls -la /var/run/docker.sock
    sudo chmod a+rw /var/run/docker.sock
    sudo ls -la /var/run/docker.sock

Run | Edit Configurations | + | Node.js

* "Name" = "nodejs loopback docker"
* "Working directory" = "~/www/code-example/nodejs/loopback"
* "Docker container settings" | "Volume bindings" | "/home/boris/www/code-example/nodejs/loopback" -> "/home/node"

See details on https://www.jetbrains.com/help/phpstorm/node-with-docker.html 
and https://www.jetbrains.com/help/phpstorm/installing-and-removing-external-software-using-node-package-manager.html

methods: nodejs/loopback/node/node_modules/@loopback/repository/dist/connectors/crud.connector.d.ts deleteAll
webhooks: nodejs/loopback/node/node_modules/loopback-datasource-juggler/lib/dao.js deleteAll
observer: nodejs/loopback/node/node_modules/loopback-datasource-juggler/lib/observer.js notifyObserversOf
