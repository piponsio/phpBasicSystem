# phpBasicSystem
Based on the CodeIgniter4 framework, phpBasicSystem or PBS it was created to quickly generate websites suitable for beginners and experts through its intuitive interfaces and its simple but powerful architecture.

## Installation for Linux Debian

1. **Download phpBasicSystem**

Go to www directory and clone this repository.
If you not have git installed, install.
```
sudo apt-get install git
cd /var/www
sudo git clone https://github.com/piponsio/phpBasicSystem.git site-example
sudo chown -R www-data:www-data site-example
cd site-example
sudo chmod 775 writable
```

2. **Install necessary programs**
```
sudo apt-get install apache2 php php-mysql php-intl php-mbstring php-mysqlnd mariadb-server -y 
```

3. **Config apache**

First is need activate mysql driver.
```
sudo phpenmod mysqli
```
Activate rewrite mode.
```
sudo a2enmod rewrite
```
We create and modify the configuration file of our site.

```
sudo nano /etc/apache2/sites-available/site-example.conf
```
Notes:
* *nano is a text editor, you can use the one you prefer.*
* *site-example is the name of the configuration file of your site, this name can be any but terminated in .conf, in addition it can exist previously or be created with this command.*

**/etc/apache2/sites-available/site-example.conf**
```
<VirtualHost *:80>
	ServerAdmin webmaster@site-example.com
	DocumentRoot /var/www/site-example/public

	ServerName site-example.com
	ServerAlias www.site-example.com

	RewriteEngine on

	<Directory '/var/www/site-example/public'>
		AllowOverride All
	</Directory>

	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

```
Notes:
* *If your site is a local site, use localhost like Servername.*

After modifying the file we proceed to activate it and restart apache2.
```
sudo a2ensite site-example.conf
sudo systemctl restart apache2
```

4. **Config MariaDB**

Go to mariadb like root user.
```
sudo mariadb
```
Create a user and database, if you have this skip this step.

Create user and give privileges.
```
CREATE USER 'my-user'@'localhost' IDENTIFIED BY 'my-password';
GRANT ALL PRIVILEGES ON * . * TO 'my-user'@'localhost';
```
Create database and exit.
```
CREATE DATABASE my-db;
exit
```

5. **Config phpBasicSystem**

Go to config directory and edit config.php and database.php.
```
sudo nano /var/www/site-example/app/Config/App.php
```
In the 26 line put your base url.

**/var/www/site-example/application/config/config.php**
```
public $baseURL = 'http://www.site-example.com/';
```
Notes:
* *If your site is a local site, use http://localhost/ like baseUrl*


Using the data in the step 4, we will complete the database config.
```
sudo nano /var/www/site-example/app/Config/Database.php
```
Modify the section.

**/var/www/site-example/application/config/database.php**
```
public $default = [
	'DSN'      => '',
	'hostname' => 'localhost',
	'username' => 'my-user',
	'password' => 'my-password',
	'database' => 'my-db',
	'DBDriver' => 'MySQLi',
	'DBPrefix' => '',
	'pConnect' => false,
	'DBDebug'  => (ENVIRONMENT !== 'production'),
	'cacheOn'  => false,
	'cacheDir' => '',
	'charset'  => 'utf8',
	'DBCollat' => 'utf8_general_ci',
	'swapPre'  => '',
	'encrypt'  => false,
	'compress' => false,
	'strictOn' => false,
	'failover' => [],
	'port'     => 3306,
];
``` 

6. **Install PhpBasicSystem**

Open your favorite browser and go to your base url http://www.site-example.com/install, follow the instructions and complete the last form.

## Apply latest updates in my project
*Pending...*
