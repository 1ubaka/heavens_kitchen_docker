# heavens_kitchen_docker

# Heaven's Kitchen - Docker Compose Project

## Описание

Heaven's Kitchen е уеб приложение за поръчка на храна, разработено с PHP и MySQL. Проектът е контейнеризиран с Docker и Docker Compose, което позволява лесно стартиране и управление на всички необходими услуги.

## Използвани технологии

* PHP 
* Apache Web Server
* MySQL 
* phpMyAdmin
* Docker
* Docker Compose
* HTML
* CSS
* Bootstrap

---

## Структура на проекта

```text
heavens-kitchen-docker/
│

├── web/
│   ├── Dockerfile
│   ├── index.php
│   ├── login.php
│   ├── register.php
│   ├── cart.php
│   ├── checkout.php
│   ├── assets/
│   ├── includes/
│   └── ...
│
├── db/
│   └── db.sql
│
├── compose.yml
```

---

## Услуги

### 1. Web Service

Контейнерът съдържа PHP приложение и Apache уеб сървър.

* Изграден чрез Dockerfile
* Стартира уеб приложението
* Достъпен на порт 8080

### 2. Database Service

Контейнер с MySQL 8.0.

* Съхранява потребители, продукти и поръчки
* Зарежда автоматично базата данни от файла `db.sql`
* Работи на порт 3306 (достъпен вътрешно в Docker мрежата)

### 3. phpMyAdmin Service

Уеб интерфейс за управление на MySQL.

* Достъпен на порт 8081

---

## Комуникация между услугите

Docker Compose създава собствена вътрешна мрежа.

PHP приложението се свързва към MySQL чрез името на услугата:

```php
$host = "db";
```

където `db` е името на MySQL услугата в `compose.yml`.

По този начин контейнерите комуникират директно помежду си без използване на localhost.

---

## Изграждане на контейнерите

Отворя се терминал в главната директория на проекта и се изпълнява:

```bash
docker compose build
```

---

## Стартиране на проекта

```bash
docker compose up
```

или

```bash
docker compose up --build
```

---

## Спиране на проекта

```bash
docker compose down
```

---

## Изтриване на контейнерите и данните

```bash
docker compose down -v
```

---

## Достъп до приложението

### Уеб приложение

```text
http://localhost:8080
```

### phpMyAdmin

```text
http://localhost:8081
```

Вход:

```text
Username: root
Password: rootpassword
```

---

## Docker образи

Web образът е публикуван в Docker Hub:

```text
https://hub.docker.com/repository/docker/1ubaka/heavens-kitchen-web/general
```

---


