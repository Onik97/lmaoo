# Prerequisites

##Install [XAMPP](https://www.apachefriends.org/download.html) 

To run Apache and PHP on your local

## Install [Composer](https://getcomposer.org/download/) 

To install the required packages for this project \

In Mac, to install composer run the following:

```bash 
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
> Note: You may also run `mv composer.phar /usr/local/bin/composer` to use composer on your terminal

### Setup

1. Clone the repository on your local machine
2. Navigate to the root directory of the project on command line and run the following

```bash 
composer install
```
3. You may also run the following command
```bash 
composer update
```
This will install and update the required packages to run the lmaoo project

### Virtual Server
Apache has to run a virtual host for lmaoo MVC architecture to work correctly. You will need to make a configuration file.

Linux: Create a new conf file -> Name it lmaoo.local.conf (Extension is very important here)
Mac: Open httpd.conf and paste the following at the end of the conf file

```conf
<VirtualHost *:80>
    ServerName lmaoo.local
    DocumentRoot /mnt/c/xampp/htdocs/www/lmaoo/App/src

    <Directory /mnt/c/xampp/htdocs/www/lmaoo/App/src>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php [L]
        Options FollowSymLinks
        AllowOverride  All
    </Directory>
</VirtualHost>
```
> Note: The Document Root and Directory may be different according to the location of the repo!

#### Finding .conf Location 
Linux: /etc/apache2/sites-available -> sudo a2ensite lmaoo.local.conf \
Mac: /Applications/XAMPP/xamppfiles/apache2 -> httpd.conf \
Windows: Watch this [video](https://www.youtube.com/watch?v=2eebptXfEvw) and go to 6:02:13 and watch the rest of the section.

#### Hosts File

Now that you got the conf file up and running you will need to edit the host file
Windows: C:\Windows\System32\drivers\etc
Linux and Mac: Run the following command in linux -> sudo nano /etc/hosts \ 
Paste the following to your hosts file
```txt
127.0.0.1       lmaoo.local
::1             lmaoo.local
```
> Note: If you are part of the OTAL Team, I will also provide QA and Staging endpoints on the discord server!

### Contributing
The OTAL team is only allowed to modify code for this project. Applicants are more than welcome to join the team! Create a issue with your email address and I will contact you.

### License
MIT