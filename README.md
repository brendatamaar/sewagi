<h1 align="center" id="title">Sewagi</h1>

<h2>🛠️ Installation Steps:</h2>

<p>1. Create a database locally</p>

<p>2. Download composer</p>

```
https://getcomposer.org/download/
```

<p>3. Rename .env.example file to .envinside your project root and fill the database information.</p>

<p>4. Install Composer</p>

```
composer install
```

<p>5. Sets the APP_KEY value in your .env file</p>

```
php artisan key:generate
```

<p>6. Publishes all our schema to the database</p>

```
php artisan migrate
```

<p>7. Insert data into database</p>

```
php artisan db:seed
```

<p>8. Install npm</p>

```
npm install
```

<p>9. Build webpack</p>

```
npm run build
```

<p>10. Run the project</p>

```
php artisan serve
```

  
  
<h2>💻 Built with</h2>

Technologies used in the project:

*   Laravel
*   Node JS
*   Saas
