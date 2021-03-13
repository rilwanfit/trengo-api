.DEFAULT_GOAL:=help
.DOCKER_COMPOSE := docker-compose -f docker-compose.yml
.DOCKER_COMPOSE_LARADOCK := cd ./laradock && docker-compose
.DOCKER_RUN_WORKSPACE := $(.DOCKER_COMPOSE_LARADOCK) exec workspace

# -- Default -- #
.PHONY: setup start stop destroy migrate seed generate-docs test qa calculated-weighted-average
setup: cp-env-file dependencies  ## Setup the Project
start: up ## Start the project
stop: down ## Stop the project
destroy: down-with-volumes ## Destroy the project and its volumes
migrate: db-migrate ## Run migrations
seed: db-seed calculated-weighted-average ## Run seeders
calculated-weighted-average: calculated-weighted-average ##
generate-docs: generate-docs
test: test ## Run the test suite
qa: composer-validate php-cs-fixer phpstan ## Run the quality assurance suite
# -- // Default -- #

# -- Utility -- #
up:
	$(.DOCKER_COMPOSE_LARADOCK) up -d nginx mysql phpmyadmin redis
	$(call banner)

down:
	$(.DOCKER_COMPOSE_LARADOCK) down

down-with-volumes:
	$(.DOCKER_COMPOSE_LARADOCK) down --remove-orphans --volumes

shell: ## Start a shell in docker container
	$(.DOCKER_RUN_WORKSPACE) bash

dependencies: composer.json
	$(.DOCKER_COMPOSE_LARADOCK) up -d workspace
	$(.DOCKER_RUN_WORKSPACE) composer install --no-interaction --no-scripts --ansi
	$(.DOCKER_RUN_WORKSPACE) yarn install

cp-env-file:
	cp .env.example .env
	cp ./laradock/env-example ./laradock/.env

generate-key:
	$(.DOCKER_RUN_WORKSPACE) php artisan key:generate

generate-docs:
	$(.DOCKER_RUN_WORKSPACE) php artisan apiato:apidoc

db-migrate:
	$(.DOCKER_RUN_WORKSPACE) php artisan migrate

db-seed:
	$(.DOCKER_RUN_WORKSPACE) php artisan db:seed

calculated-weighted-average:
	$(.DOCKER_RUN_WORKSPACE) php artisan trengo:update:weighted-average-rating

phpstan:
	$(.DOCKER_RUN_WORKSPACE) php -d memory_limit=4G ./vendor/bin/phpstan analyse -l max src/

php-cs-fixer:
	$(.DOCKER_RUN_WORKSPACE) ./vendor/bin/php-cs-fixer fix --allow-risky=yes

composer-validate:
	$(.DOCKER_RUN_WORKSPACE) composer validate --strict

test:
	$(.DOCKER_RUN_WORKSPACE) vendor/bin/phpunit --stop-on-failure --testdox

# Based on https://suva.sh/posts/well-documented-makefiles/
help:  ## Display this help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)
