



How to setup locally

-  Clone the repository
```bash
git clone https://github.com/developeralamin/Api_Chat
```

- Install dependencies
```bash
composer install
```
OR
-If composer its now work run this command
```bash
composer update
```

- Create a copy of your .env file
```
cp .env.example .env
```

- Generate an app encryption key
```bash
php artisan key:generate
```

- Create Database Name .env file
```
DB_DATABASE = 
```
- Run migrations
```bash
php artisan migrate
```

- For demo data
```bash
    php artisan db:seed
```


- Run the local development server
```bash
php artisan serve
```
