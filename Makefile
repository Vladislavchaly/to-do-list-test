
COMPOSE_FILE = docker-compose.yml

DC = docker compose

D = docker

APP_CONTAINER = laravel-app

.PHONY: env
env:
	cp .env.example .env

.PHONY: start
start:
	@echo "Building the project..."
	$(DC) build
	@echo "Starting the project"
	$(DC) up -d
	@echo "Running Composer install..."
	$(D) exec $(APP_CONTAINER) composer install
	@echo "Running migrations..."
	$(D) exec $(APP_CONTAINER) php artisan migrate
	@echo "Clearing cache..."
	$(D) exec $(APP_CONTAINER) php artisan cache:clear
	@echo "Generate App key..."
	$(D) exec $(APP_CONTAINER) php artisan key:generate

.PHONY: sh
sh:
	$(D) exec -it $(APP_CONTAINER) /bin/bash

.PHONY: down
down:
	@echo "Stopping the project..."
	$(DC) down

.PHONY: up
up:
	@echo "Starting the project..."
	$(DC) up -d

.PHONY: rebuild
rebuild:
	@echo "Rebuilding the project..."
	$(DC) down
	$(DC) up --build -d
	@echo "Running Composer install..."
	$(D) exec $(APP_CONTAINER) composer install
	@echo "Running migrations..."
	$(D) exec $(APP_CONTAINER) php artisan migrate
	@echo "Clearing cache..."
	$(D) exec $(APP_CONTAINER) php artisan cache:clear