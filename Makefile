.PHONY: up down start stop restart destroy build logs ps sh manage check makemigrations migrate shell dbshell collectstatic changepassword

RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))


THIS_FILE := $(lastword $(MAKEFILE_LIST))

# Defining the user's UID and GID. It is used to avoid file permission issues
UID := $(shell id -u)
GID := $(shell id -g)


# Avoiding issue with "docker compose" and "docker-compose" by checking which one is used in the system
DOCKER_COMPOSE := $(shell command -v docker-compose 2> /dev/null || echo docker compose)

# Sometimes this file is called "docker-compose.yml" and Sometimes "docker-compose.yaml", this line sets which one is gonna be used
COMPOSE_FILE := $(if $(wildcard docker-compose.yaml),docker-compose.yaml,docker-compose.yml)

# Generic targets
help:
	@make -pRrq  -f $(THIS_FILE) : 2>/dev/null | awk -v RS= -F: '/^# File/,/^# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | egrep -v -e '^[^[:alnum:]]' -e '^$@$$'

# Docker Compose
up:
	UID=$(UID) GID=$(GID)	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) up -d $(RUN_ARGS)
down:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) down $(RUN_ARGS)
start:
	UID=$(UID) GID=$(GID)	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) start $(RUN_ARGS)
stop:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) stop $(RUN_ARGS)
restart:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) stop $(RUN_ARGS)
	UID=$(UID) GID=$(GID)	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) up -d $(RUN_ARGS)
destroy:
	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) down -v $(RUN_ARGS)
build:
	UID=$(UID) GID=$(GID)	$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) build $(RUN_ARGS)
exec:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec $(RUN_ARGS)
logs:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) logs -f $(RUN_ARGS)
ps:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) ps $(RUN_ARGS)
sh:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec $(RUN_ARGS) sh -c 'if command -v bash &> /dev/null; then bash; else sh; fi'


# Laravel
LARAVEL_CONTAINER_NAME := "laravel"
artisan:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec $(LARAVEL_CONTAINER_NAME) php artisan $(RUN_ARGS)
model:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec $(LARAVEL_CONTAINER_NAME) php artisan make:model $(RUN_ARGS) -m
controller:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec $(LARAVEL_CONTAINER_NAME) php artisan make:controller -r -m $(RUN_ARGS) # <Model> <Controller>


# Nuxt
NUXT_CONTAINER_NAME := "nuxt"
npm:
	@$(DOCKER_COMPOSE) -f $(COMPOSE_FILE) exec $(NUXT_CONTAINER_NAME) npm $(RUN_ARGS)


# Overriding targets other then the first one, so we could use targets as positional arguments (e.g: make manage check)
$(RUN_ARGS):
	@:
