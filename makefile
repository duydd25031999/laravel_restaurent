serve:
	php artisan serve
watch:
	npm run watch
migrate:
	php artisan migrate
up:
	docker-compose up
down:
	docker-compose down
stop:
	docker-compose stop
mysql-bash:
	docker exec -it mysql_container mysql -uroot -pabc
docker-migrate:
	docker exec php_container php artisan migrate
php-bash:
	docker exec -it php_container bash
make-container:
	docker exec php_container php artisan make:controller ${name}
vendor-telegram:
	docker exec php_container php artisan vendor:publish --provider="Telegram\Bot\Laravel\TelegramServiceProvider"
