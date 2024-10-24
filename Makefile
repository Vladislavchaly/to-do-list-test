
COMPOSE_FILE = docker-compose.yml

DC = docker-compose -p to-do-list-test

APP_CONTAINER = laravel-app

.PHONY: start
start:
	@echo "Building the project..."
	$(DC) build
	@echo "Running Composer install..."
	$(DC) run --rm $(APP_CONTAINER) composer install
	@echo "Running migrations..."
	$(DC) run --rm $(APP_CONTAINER) php artisan migrate
	@echo "Building assets..."
	$(DC) run --rm $(APP_CONTAINER) php artisan asset:publish
	@echo "Clearing cache..."
	$(DC) run --rm $(APP_CONTAINER) php artisan cache:clear

.PHONY: up
up:
	@echo "Starting the project..."
	$(DC) up -d

.PHONY: down
down:
	@echo "Stopping the project..."
	$(DC) down

.PHONY: rebuild
rebuild:
	@echo "Rebuilding the project..."
	$(DC) down
	$(DC) build
	@echo "Running Composer install..."
	$(DC) run --rm $(APP_CONTAINER) composer install
	@echo "Running migrations..."
	$(DC) run --rm $(APP_CONTAINER) php artisan migrate
	@echo "Building assets..."
	$(DC) run --rm $(APP_CONTAINER) php artisan asset:publish
	@echo "Clearing cache..."
	$(DC) run --rm $(APP_CONTAINER) php artisan cache:clear
	$(DC) up -d