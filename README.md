#                             `Leave Tracker`
## Project Installation

Install ``composer``.

```
composer install
```

Copy ``.env.example`` file to ``.env`` file and set custom information.

```
cp .env.example .env
```

Generate key in ``.env`` file.

```
php artisan key:generate
```

Link ``storage``.

```
php artisan storage:link
```

Migrate database migrations with seeds.

```
php artisan migrate --seed
```

Install ``npm``

```
npm install
```

NPM run in local ``npm``

```
npm run dev
```

NPM run in production ``npm``

```
npm run build
```
