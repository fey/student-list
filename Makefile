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

test:
	composer exec phpunit

test-coverage-output:
	XDEBUG_MODE=coverage composer exec phpunit -- --coverage-text

test-coverage-html:
	XDEBUG_MODE=coverage composer exec phpunit -- --coverage-html=./tmp/report
