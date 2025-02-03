<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Installation

This app runs best with Laravel Sail and needs Docker to be installed on your machine.

```
./vendor/bin/sail up
```

## Generate OpenAPI documentation

After you have installed the required Composer packages you can execute the following command. 
If you have a corresponding plugin for your IDE, you can execute all interfaces in it. Alternatively, apps such as 
Postman or Bruno offer the option of importing the generated file.

```
./vendor/bin/openapi app -o openapi.yaml
```
