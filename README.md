### Project Setup

First Clone the repository:

```bash
git clone https://github.com/sohan065/Inflexionpoint-Technology-Task.git

```

Go to the project directory.

```bash
cd Inflexionpoint-Technology-Task
```

Install the composer & npm dependencies.

```bash
composer install
```

#### Env Configuration.

Copy the `.env.example` file to `.env` and update the database credentials.

```bash
cp .env.example .env

```

Generate artisan key.

```bash
php artisan key:generate
```

#### Database Migration & Seeding.

Configure your database in `.env` file.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

#### Mail Configuration .

Configure your mail in `.env` file.

```dotenv
MAIL_MAILER=your_mailer
MAIL_HOST=your_mail_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="yourmail@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Then run the database migration command to create the tables.

```bash
php artisan migrate
```

Then run the command to seeding dummy data.

```bash
php artisan db:seed --class=CategorySeeder --class=ProductSeeder --class=UserSeeder

```

now Run the job.

```bash
php artisan queue:work
```

Finally, Run the server.

```bash
php artisan serve
```

It will serve the app on `http://127.0.0.1:8000` by default.

### user log In

use this `mail` and `password` for log in

```
mail: admin@example.com
password: 1234

```

after successfully log in , you will redirect in dashboard .
