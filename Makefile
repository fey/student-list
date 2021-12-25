install:
	composer install

start:
	php -S localhost:8000 -t public/

lint:
	composer exec phpcs -- --standard=psr12 public

lint-fix:
	composer exec phpcbf -- --standard=psr12 public

static-analyse:
	composer exec phpstan analyse

migrate:
	echo "start migration"
