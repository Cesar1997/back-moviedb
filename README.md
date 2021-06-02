## Requerimientos
1) php "php": "^7.3|^8.0"
1) composer apuntando a la versión de php

## Guia de instalación
1) git clone https://github.com/Cesar1997/back-moviedb.git
2) cd back-moviedb
3) composer install --ignore-platform-reqs
4) ir a nuestro gestor de base de datos y ejecutar <code> CREATE DATABASE moviedb_tribal_test; </code>
5) para ejecutar las migraciones <code> php artisan migrate:fresh --seed </code>
6) levantar locahost <code> php artisan serve </code> (es necesario que se abra en el puerto 8080 http://127.0.0.1:8000)
7) Consumier web services  https://documenter.getpostman.com/view/8699958/TzY3AFPM

