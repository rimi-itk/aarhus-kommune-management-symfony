# aarhus-kommune-management-symfony

https://github.com/rimi-itk/aarhus-kommune-management-bundle

```sh
docker-compose up --detach
docker-compose exec phpfpm composer install
docker-compose exec phpfpm bin/console doctrine:migrations:migrate --no-interaction
```

```sh
docker-compose exec phpfpm bin/console fos:user:create --super-admin admin@example.com admin@example.com password
```
