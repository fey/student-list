setup:
	touch database/development.sqlite3
	touch database/testing.sqlite3
	make install

install:
	composer install

start:
	php -S localhost:8000 -t public/

lint:
	composer exec phpcs

lint-fix:
	composer exec phpcbf

static-analyse:
	composer exec phpstan analyse

migrate:
	php bin/migrate
