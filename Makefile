COMPOSE_FILES=docker-compose.yml
USER=app
GROUP=app

$(eval CURRENT_UID=$(shell id -u))
$(eval CURRENT_GID=$(shell id -g))


define modify_uid_gid
    $(eval CURRENT_UID=$(shell id -u))
    $(eval CURRENT_GID=$(shell id -g))

    @if [ "$(CURRENT_UID)" -lt "1000" ]; then\
        echo 'You must run target as user has UID >= 1000';\
        exit 1;\
    fi


    @docker-compose -f $(COMPOSE_FILES) exec php_simple_crud sh -c 'usermod $(USER) -u $(CURRENT_UID) && groupmod $(GROUP) -og $(CURRENT_GID)'
    @docker-compose -f $(COMPOSE_FILES) exec php_simple_crud sh -c 'chmod 777 -R storage/logs/*'
    @docker-compose -f $(COMPOSE_FILES) exec php_simple_crud sh -c 'chmod 777 -R storage/framework/*'
endef

build:
	docker-compose -f $(COMPOSE_FILES) up -d --build
	$(modify_uid_gid)
up:
	docker-compose -f $(COMPOSE_FILES) up -d
	$(modify_uid_gid)
destroy:
	docker-compose -f $(COMPOSE_FILES) down

status:
	docker-compose -f $(COMPOSE_FILES) ps

shell:
	docker-compose -f $(COMPOSE_FILES) exec --user=$(USER) php_simple_crud zsh

shell-as-root:
	docker-compose -f $(COMPOSE_FILES) exec php_simple_crud zsh

update:
	docker-compose -f $(COMPOSE_FILES) exec --user=$(USER) php_simple_crud 'composer update'
	docker-compose -f $(COMPOSE_FILES) exec --user=$(USER) php_simple_crud 'php artisan migrate'
