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
	echo "start migration"
