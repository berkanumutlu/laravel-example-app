<p align="center"><a href="https://laravel.com" target="_blank" rel="nofollow"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://laravel.com/docs/10.x" target="_blank" rel="nofollow"><img src="https://img.shields.io/badge/Laravel-10.29.0-F23A2F" alt="Laravel Version"></a>
<a href="https://www.php.net/releases/8_1_23.php" target="_blank" rel="nofollow"><img src="https://img.shields.io/badge/PHP-8.1.23-7A86B8" alt="PHP Version"></a>
<a href="https://github.com/berkanumutlu/laravel-example-app/blob/master/LICENSE" target="_blank" rel="nofollow"><img src="https://img.shields.io/github/license/berkanumutlu/laravel-example-app" alt="License"></a>
</p>

# Laravel Example App

It is an article publishing web project using Laravel. There is an admin panel within the project. In the admin panel,
administrators and users can be created, articles can be added, edited and deleted, categories can be added, edited and
deleted, and categories can be assigned to articles. On the web side, users can view the list of articles, filter by
categories, and comment on articles.

# Installation

```sh
$ docker-compose up
```

```sh
$ docker ps
```

```sh
$ docker exec -it {PHP8_CONTAINER_ID} bash
```

```sh
$ composer global require laravel/installer
```

```sh
$ composer global about
```

```sh
# Changed current directory to /root/.composer
# Composer - Dependency Manager for PHP - version 2.6.5
# Composer is a dependency manager tracking local dependencies of your projects and libraries.
# See https://getcomposer.org/ for more information.
```

```sh
$ export PATH="/root/.composer/vendor/bin:$PATH"
```

```sh
$ laravel new project
```

```sh
$ cd project
$ php artisan serve
```