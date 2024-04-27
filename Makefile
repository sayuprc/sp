.DEFAULT_GOAL := help

UID := $(shell id -u)
USERNAME := $(shell id -u -n)
GID := $(shell id -g)
GROUPNAME := $(shell id -g -n)

.PHONY: build
build: ## Build a docker image
	docker build \
		-t sp:0.1 \
		--build-arg UID=${UID} \
		--build-arg GID=${GID} \
		--build-arg USERNAME=${USERNAME} \
		--build-arg GROUPNAME=${GROUPNAME} \
		.

.PHONY: up
up: ## Start the container
	docker compose up -d

.PHONY: down
down: ## Delete the container
	docker compose down

.PHONY: install
install: ## Install libraries
	docker compose exec sp composer install

.PHONY: cs
cs: ## Check code format
	docker compose exec sp composer cs

.PHONY: csf
csf: ## Execute code formatting
	docker compose exec sp composer csf

.PHONY: stan
stan: ## Perform static analysis
	docker compose exec sp composer stan

.PHONY: tests
tests: ## Running tests
	docker compose exec sp composer tests

.PHONY: help
help: ## Display a list of targets
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'
