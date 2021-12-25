start:
	php -S localhost:8000 -t public/

install:
	composer install

lint:
	composer exec phpcs -- --standard=psr12 public

lint-fix:
	composer exec phpcbf -- --standard=psr12 public

phpstan:
	composer exec phpstan analyse public

migrate:
	echo "start migration"
