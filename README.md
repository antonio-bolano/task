<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Installation

This app runs best with Laravel Sail and needs Docker to be installed on your machine.


## 1. Change branch

```
git checkout feature/task-api
```

## 2. Install composer packages

```
composer install
```

Necessary PHP extension may have to be installed first. (Live mb-string, xml, zip, curl)



## 3. Paste .env file


## 4. Start containers

```
./vendor/bin/sail up
```

## 5. Run migrations

This will also seed the tables with some test data.
```
./vendor/bin/sail artisan migrate:fresh --seed
```

## (Optional) Generate OpenAPI documentation

After you have installed the required Composer packages you can execute the following command. 
If you have a plugin for your IDE to view OpenAPI v3 files, you can execute all routes in it. Alternatively, apps such as 
Postman or Bruno offer the option to import the generated file.

```
./vendor/bin/openapi app -o openapi.yaml
```

## MySQL container keeps shutting down
```
docker compose down
docker rm -f $(docker ps -a -q --filter name=mysql)
rm /tmp/mysql.sock    # You may need sudo
./vendor/bin/sail up
```

If the issue persists, try:

```
sail down -v    # Removes volumes
sail up
```

