# Mentor Wizard

Mentor Wizard - це сучасний веб-застосунок, розроблений на базі фреймворку Laravel, що виконує управління менторами та студентами для освіти, наповнений функціоналом сучасного веб-додатка.

## Вимоги

Для розгортання проєкту локально на вашому комп'ютері необхідно мати:
- PHP v8.3 або новішу версію
- Composer
- PostgreSQL
- Redis
- Node.js та Yarn

## Установка

Виконайте наступні кроки, щоб налаштувати проєкт локально:

### 1. Клонування репозиторію

Склонуйте репозиторій проєкту:

```bash
git clone git@gitlab.com:mentor-wizard/mentor-wizard-webapp.git
cd mentor-wizard-webapp
```

### 2. Запуск контейнерів Docker

Виконайте команду:

```bash
docker compose up -d
```

### 3. Установка залежностей Laravel

Виконайте команду:

```bash
docker compose exec -it app composer install
```

### 4. Скопіюйте .env файл

Виконайте команду:

```bash
docker compose exec -it app cp .env.example .env
```

### 5. Згенеруйте ключ для Laravel

Виконайте команду:

```bash
docker compose exec -it app php artisan key:generate
```

### 6. Запустіть міграцію

Виконайте команду:

```bash
docker compose exec -it app php artisan migrate
```

### 7. Встановіть залежності NodeJS

Виконайте команду:

```bash
docker compose exec -it app yarn install
```

### 8. Компіляція frontend

Виконайте команду:

```bash
docker compose exec -it app yarn run dev
```

## Тестування

Щоб запустити тестування, виконайте:

```bash
docker compose exec -it app php artisan test
```

Або скористайтеся `pest` для додаткових інструментів тестування.

## DDEV Інсталяція

### Вимоги

- [DDEV](//ddev.readthedocs.io/en/stable/users/install/ddev-installation)
- [Docker Compose](//docs.docker.com/compose/install)

### Інсталяція

- Запуск DDEV. Це збілдить всі неодхідні конетйнери згідно налаштувань у
  `.ddev/config.yaml`

    ```sh
    ddev start
    ```

- Згенеруйте ключ для Laravel та запустіть міграції:

    ```sh
    ddev artisan key:generate; ddev artisan migrate
    ```

- Встановлення `Node.js` залежностей:
    ```
    ddev [npm|yarn|pnpm] install
    ```

## Ліцензія

Цей проєкт ліцензований за ліцензією [MIT](https://opensource.org/licenses/MIT).
