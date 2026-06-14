# DevOps, DevSecOps, MLOps, LLMOps, Platform Engineer, Site Reliability Engineer

## Overview

* [**Traefik**](#traefik) - the primary ingress controller, reverse proxy, load balancer, firewall. It automatically provisions HTTPS certificates, sanitizes incoming traffic, either blocks malicious requests at the edge or routes them to target services.

* [**App**](#app) - the core service (site). Nginx performs URI-based path routing to proxy requests to the Frontend or Backend, generates access/error log.

* [**Monitoring**](#monitoring) - high-observability layer tracking server metrics and telemetry. It ingests Nginx log streams via a reliable log-shipping pipeline to dynamically flag security threats, trigger automated IP blocks (via CrowdSec bouncers in Traefik), route alerts, render performance dashboards.

* [**AI**](#ai) - an automated operations assistant. It parses incident log failures, injects them into a LangGraph workflow, uses local LLM inference via Ollama to generate root-cause analysis (RCA) and remediation commands.

```
                       ┌─────────────────┐
                       │ user            │
                       └─────────┬───────┘
                       ┌─────────▼───────┐
        ┌──────────────┤ Traefik         ├─┬──────────────────┬───┬─┐
        │              └─▲───────────────┘ │                  │   │ │
┌───────┼────────────┐ ┌─┼─────────────────┼─────────┐ ┌──────┼───┼─┼─┐
│   ┌───▼────┐       │ │ │┌────────────┐ ┌─▼───────┐ │ │┌─────▼──┐│ │ │
│   │ Nginx  ├───┐   │ │ ││ Prometheus ├─► Grafana │ │ ││ MLflow ││ │ │
│   └──┬────┬┘   │   │ │ │└────────────┘ └─▲───────┘ │ │└─────▲──┘│ │ │
│┌─────▼───┐│┌───▼──┐│ │┌┴─────────┐┌──────┴────────┐│ │┌─────┴───▼┐│ │
││ Backend │││ logs ├┼─┼► Crowdsec ││ Elasticsearch ├┼─┼► N8n      ││ │
│└─────┬───┘│└───┬──┘│ │└─────▲────┘└──────▲────────┘│ │└─────┬────┘│ │
│┌─────▼───┐│    │   │ │┌─────┴─────┐┌─────┴────────┐│ │┌─────▼────┐│ │
││ DB      ││    │   │ ││ Crowdsec  ││ Logstash     ││ ││ Ollama   ││ │
│└─────────┘│    │   │ ││ blocklist │└─────▲────────┘│ │└─────┬────┘│ │
│   ┌───────▼──┐ │   │ ││ import    │      │         │ │┌─────▼─────▼┐│
│   │ Frontend │ │   │ │└───────────┘┌─────┴────────┐│ ││ Open-webUI ││
│   └──────────┘ └───┼─┼─────────────► Filebeat     ││ │└────────────┘│
│ App                │ │ Monitoring  └──────────────┘│ │ AI           │
└────────────────────┘ └─────────────────────────────┘ └──────────────┘
```

## Architecture FAQ

### Traefik and Nginx are both reverse proxies. Why use both simultaneously?

Using a single reverse proxy (regardless of whether it's [Traefik](#traefik) or [Nginx](#nginx)) for a simple monolithic application without other services is a perfectly suitable solution. However, for a project encompassing diverse logical services, this approach violates the Single Responsibility Principle (SRE / SOLID) and significantly complicates maintenance.

Using two identical reverse proxies ([Traefik](#traefik)-[Traefik](#traefik) or [Nginx](#nginx)-[Nginx](#nginx)) is an architectural anti-pattern. At least one of them will perform sub-optimally. 

The optimal approach: using [Traefik](#traefik) and [Nginx](#nginx) together creates a highly efficient, tiered proxy architecture. Instead of competing, they act as a synergistic pairing where each tool focuses purely on its core strength:

* [**Traefik**](#traefik) is the **external edge proxy (ingress)**. It manages the global entry point of the server, handles dynamic Let's Encrypt SSL orchestration, integrates with [CrowdSec](#crowdsec) to block malicious traffic before it hits services.

* [**Nginx**](#nginx) is the **internal application proxy**. It locates directly inside the App boundary to handle path-based routing, serve static assets instantly from cache, execute custom high-speed Lua security scripts closer to the code.


### Filebeat and Logstash are both data processors. Why use both simultaneously?

This combination follows the industry-standard "Lightweight shipper + Heavyweight transformer" pattern to protect server resources:

* **Filebeat** is a featherweight agent that consumes almost zero CPU/RAM. Its only job is to sit near the application logs, monitor files for updates, perform minor type casting, ship them out immediately.

* **Logstash** is a heavy Java-based engine. By offloading it from the main application environment, it can perform intensive computational data transformations.


## Detailed description

All infrastructure components operate as containerized services within Docker.


### Traefik

The primary cloud-native ingress controller, reverse proxy, load balancer, firewall.

* **Automated SSL/TLS lifecycle**: Automatically provisions and renews Let's Encrypt HTTPS certificates on the fly. This includes dynamic generation whenever a new service is introduced, ensuring zero downtime for existing services. This decoupling allows services to be stopped, updated, deployed hot-swappable and completely independent of one another.

* **Edge protection & routing**: Sanitizes incoming traffic at the edge. It acts as an inline firewall by cross-referencing real-time telemetry from [CrowdSec](#crowdsec) to instantaneously block malicious actors before they hit downstream services, routing only verified traffic to its intended destination.

* **Middlewares**: Leverages a robust middleware architecture to enforce cross-cutting concerns, such as standardizing Basic/OAuth authentication blocks to secure internal management dashboards over the public internet.

[Source configuration](./traefik/), [Docker configuration](./traefik/docker-compose.yml), [service configuration](./traefik/traefik/).

### App

The core services (site). [Source configuration](./app/), [Docker configuration](./app/docker-compose.yml).

#### Nginx

Nginx + Lua integration = OpenResty.

* Performs URI-based path routing to proxy requests directly to the [Frontend](#frontend) or [Backend](#backend).
* Generates system access and error `logs`.
* Features built-in traps for malicious bots, triggering instantaneous local bans. Additionally malicious IPs are propagated to [CrowdSec](#crowdsec) to execute an infrastructure-wide firewall block.

[Docker configuration](./app/docker-compose.yml#L14), [service configuration](./app/nginx/).

#### Frontend

Serves static assets including HTML, JS, CSS, PNG, JPG, etc. Nginx delivers these files directly from the cache for maximum performance. [Nginx configuration](./app/nginx/conf.d/_.conf.include#L18).

#### Backend

Handles the core business and application logic. Responses are governed by Role-Based Access Control (RBAC). [Docker configuration](./app/docker-compose.yml#L43), [Nginx configuration](./app/nginx/conf.d/_.conf.include#L27).

#### Other Services

In a production environment this layer typically expands to include a high-availability database cluster (one Master write-only node and multiple Slave read-only replicas), a distributed microservices architecture, an in-memory caching layer (e.g., Redis), a message broker, etc. These have been omitted from this blueprint for architectural simplicity.


### Monitoring

[Source configuration](./monitoring/), [Docker configuration](./monitoring/docker-compose.yml).

#### CrowdSec

Analyzes `logs` using heuristic analysis to identify malicious bot behavior. It enforces immediate firewall drops on malicious bots while throttle web crawlers based on rate-limiting thresholds. [Docker configuration](./monitoring/docker-compose.yml#L16), [service configuration](./monitoring/crowdsec/).

#### CrowdSec blocklist import

Ingests known malicious IP addresses from threat intelligence feeds, including AbuseIPDB and other third-party security databases. [Docker configuration](./monitoring/docker-compose.yml#L43).

#### Filebeat

Parses `logs`, handles data sanitization and type casting (converting string numbers into pure integer or float formats) before shipping them to [Logstash](#logstash). [Docker configuration](./monitoring/docker-compose.yml#L63), [service configuration](./monitoring/filebeat/).

#### Logstash

Normalizes the incoming logs by stripping query-strings and URL fragments, decodes Punycode URLs, dispatches the clean data directly to [Elasticsearch](#elasticsearch). [Docker configuration](./monitoring/docker-compose.yml#L85), [service configuration](./monitoring/logstash/).

#### Elasticsearch

Enriches incoming log data with GeoIP metadata and additional contextual fields to enable rapid filtering and querying. Serves as the central high-retention datastore for all system logs. [Docker configuration](./monitoring/docker-compose.yml#L107), [service configuration](./monitoring/elasticsearch/).

#### Prometheus

Scrapes, processes, stores resource utilization metrics from across the entire server infrastructure. [Docker configuration](./monitoring/docker-compose.yml#L146), [service configuration](./monitoring/prometheus/).

#### Grafana

Serves as the unified visualization layer, rendering real-time metrics and analytical dashboards fetched from both [Elasticsearch](#elasticsearch) and [Prometheus](#prometheus) datasources. [Docker configuration](./monitoring/docker-compose.yml#L166).


### AI

[Source configuration](./ai/).

#### ~~AI-Agent~~

Replaced a TypeScript / Node.js AI agent with [n8n](#n8n), moving away from code-maintained logic to a flexible UI-driven automation pipeline. [LangGraph workflow](./ai/ai-agent/src/agent/DevOpsAgent.ts), [Docker configuration](./ai/ai-agent/docker-compose.yml), [source configuration](./ai/ai-agent/).

#### n8n

The visual automation and workflow orchestration engine. The autonomous AI orchestration engine. It ingests runtime incident failures from [Elasticsearch](#elasticsearch) via webhooks, executes a deterministic multi-stage workflows, drives local LLM inference via [Ollama](#ollama) to generate context-aware root-cause analyses (RCA) and explicit remediation commands. [Docker configuration](./ai/docker-compose.yml#L90).

#### Ollama

The local LLM execution runtime. [Docker configuration](./ai/docker-compose.yml#L16).

#### Open-WebUI

The UI for `Ollama`, enabling manual model testing, prompt prototyping, direct human-in-the-loop interactions. [Docker configuration](./ai/docker-compose.yml#L33).

#### MLflow

The central ML and LLM telemetry platform. It serves as the experiment tracking registry to log, audit, evaluate prompt performance, model parameters, agent execution metrics. [Docker configuration](./ai/docker-compose.yml#L63).
