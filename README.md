# CRUD-Symfony-Docker



## About the Project

Simple dockerized Symfony 5 CRUD application :

- Create, read, update, delete items(articles) with their title, content and categories.
- API (with POST and GET).

### Dependencies and prerequisites

- [Docker](https://www.docker.com/)

### Containers and versions

- [nginx](https://pkgs.alpinelinux.org/packages?name=nginx&branch=v3.10) 1.18.+
- [php-fpm](https://pkgs.alpinelinux.org/packages?name=php7&branch=v3.10) 7.4.+
  - [composer](https://getcomposer.org/)
  - [yarn](https://yarnpkg.com/lang/en/) and [node.js](https://nodejs.org/en/) (if you will use [Encore](https://symfony.com/doc/current/frontend/encore/installation.html) for managing JS and CSS)
- [mysql](https://hub.docker.com/_/mysql/) 5.7.+

### Installation of the app

Use the following commands to run the project

- docker-compose up -d --build
- docker-compose exec php composer install
- chmod -R 777 symfony/ (for linux users)
- Migration of data BDD : docker-compose exec php bin/console d:s:u --force

### Usage

- Access to localhost : http://localhost

- Access to api : http://localhost/api

- Migration DATA BDD (in case not done during installation): docker-compose exec php bin/console d:s:u --force

- Access to articles (items) : http://localhost/articles

- Access to categories : http://localhost/category

- Using theApi :

GET : http://localhost/api/articles

POST : http://localhost/api/articles
=> body
{
"title": "string",
"content": "string",
"categories": [
""
]
}

---

GET : http://localhost/api/categories

POST : http://localhost/api/categories
=> body
{
"label": "string",
"articles": [
""
]
}

### Launch project on Preprod environement :

- Another env was created for preprod environement ( see file docker-compose.preprod.yml)
- Use the following command : docker-compose -f docker-compose.preprod.yml up -d

### Versioning

This project uses [Semantic Versioning](http://semver.org/). For a list of available versions, see the [repository tag list](https://github.com/your/project/tags).

### Authors

- Jonathan Luminuku.
- Amer Cherni.
- Walid Rehioui.
