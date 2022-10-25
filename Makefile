PROJECT=`pwd | xargs basename`
TESTIMAGE=${PROJECT}:testing
USER=nginx

up:
	env UID=$$(id -u) GID=$$(id -g)  docker-compose up --build
down:
	docker-compose down
stop:
	docker-compose stop
sh:
	docker-compose exec --user=${USER} application bash
sh\:db:
	docker-compose exec database bash

setup:
	cp .env.example .env
	cp git-hooks/pre-commit-hook .git/hooks/pre-commit
	chmod +x .git/hooks/pre-commit
	env UID=$$(id -u) GID=$$(id -g) docker-compose up
code\:check:
	docker-compose exec --user=${USER} application vendor/bin/ecs check app --config easy-coding-standard.yml
code\:fix:
	docker-compose exec --user=${USER} application vendor/bin/ecs check app --config easy-coding-standard.yml --fix
config\:cache:
	docker-compose exec --user=${USER} application php artisan config:cache