setup:
	touch database/development.sqlite3
	touch database/testing.sqlite3
	make install migrate seed
	make setup-git-hooks

install:
	composer install

start:
	# APP_ENV=development
	APP_ENV=production \
	DB_HOST=ec2-34-206-148-196.compute-1.amazonaws.com \
	DB_NAME=d8isv2epucbco2 \
	DB_PASSWORD=ec848d938f7be17a937ba5f14502cfaab2d18464a7241efcfb51a70fda668c7c \
	DB_PORT=5432 \
	DB_USER=sezzlczgighozb \
	php -S localhost:8000 -t public/

migrate:
	APP_ENV=development php bin/migrate

seed:
	APP_ENV=development php bin/seed

lint:
	composer exec phpcs

lint-fix:
	composer exec phpcbf

setup-git-hooks:
	composer exec cghooks update

static-analyse:
	composer exec phpstan analyse

test:
	composer exec phpunit

test-coverage-output:
	XDEBUG_MODE=coverage composer exec phpunit -- --coverage-text

test-coverage-html:
	XDEBUG_MODE=coverage composer exec phpunit -- --coverage-html=./tmp/report

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover tmp/clover.xml

deploy:
	git push heroku
