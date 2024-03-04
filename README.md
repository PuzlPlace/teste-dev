# PuzlPlace

This project runs with Laravel 10, PHP 8.2, Redis and Mysql.

# Installation

## Go to PuzlPlace directory
```bash
cd PuzlPlace
```

## create .env file
```bash
cp .env.example .env
```

## start containers
```bash
docker-compose up -d --build
```

## Install Vue
```bash
php artisan migrate
```

```bash
npm install
```

```bash
npm run dev
```

Then open in browser:
[localhost](http://localhost)
