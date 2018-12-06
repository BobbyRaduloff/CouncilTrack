# Council Track

## Description
Council Track is a online web-app written to be used by schools where students facilitate small item purchases like tickets for events or hall-o-ween candy. To run it needs a LAMP stack with PHP 7 and mysql. It uses Bootstrap for the minimalistic design.

## Attribution
This software was developed by:
* Boris Radulov
	- ACS2020
	- b.radulov20@acsbg.org
* Ognian Trajanov Jr.
	- ACS2022
	- o.trajanov22@acsbg.org

The idea was initally put forward by Martin Kirilov (ACS2020).

## Setup
1. Download this repo in a folder in your web server directory.
2. Paste the following into your sql terminal:
```
CREATE DATABASE counciltrack CHARACTER SET UTF8 COLLATE utf8_bin;
CREATE TABLE counciltrack.users (id int NOT NULL AUTO_INCREMENT UNIQUE, username varchar(512) NOT NULL, name varchar(512) NOT NULL, password varchar(512) NOT NULL, level int NOT NULL, balance int NOT NULL);
CREATE TABLE counciltrack.tables (id int NOT NULL AUTO_INCREMENT UNIQUE, name varchar(512) NOT NULL, i int NOT NULL, same tinyint(1), items mediumtext);
CREATE TABLE counciltrack.items (id int NOT NULL AUTO_INCREMENT UNIQUE, name varchar(512), price double);
```
3. Open https://bcrypt-generator.com/ and hash the admin password.
4. `INSERT INTO counciltrack.users (username, password, level) VALUES ("admin_name", "bcrypt_hash", 0);`
5. Set up your e-mail & sql details in `send_email()` in `config.ini`.
6. Make sure your config.ini is innacessible in your `.htaccess`.
7. ???
8. Profit.

## Licensing
This piece of software is licensed under the MIT License. More information in `LICENSE`.
