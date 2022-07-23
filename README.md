
## About EBook

Display products from https://www.packtpub.com/

### Clone the repository

```ssh
git clone https://github.com/jatin-kaklotar/ebbok.git
```

### Setup Project

Once clone the repository then run composer install command inside project root directory

```ssh
composer install
```

create .env file from .env.example file and generate APP_KEY

```ssh
cp .env.example .env
php artisan key:generate
```

Now run the project
