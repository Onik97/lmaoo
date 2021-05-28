# Prerequisites

1. Install [XAMPP](https://www.apachefriends.org/download.html) to run Apache and PHP on your local
2. Install [Composer](https://getcomposer.org/download/) to install the required packages for this project

## Setup

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

## Virtual Server
Apache has to run a virtual host for lmaoo MVC architecture to work correctly. You will need to make a configuration file.

Create a new conf file -> Name it lmaoo.local.conf (Extension is very important here)

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
> Note: The Document Root and Directory may change according to the location of the repo!

### Finding .conf Location 
Linux: /etc/apache2/sites-available -> sudo a2ensite lmaoo.local.conf \
Windows: Watch this [video](https://www.youtube.com/watch?v=2eebptXfEvw) and go to 6:02:13 and watch the rest of the section.

### Hosts File

Now that you got the conf file up and running you will need to edit the host file
Windows: C:\Windows\System32\drivers\etc
Linux: Run the following command in linux -> sudo nano /etc/hosts \ 
Paste the following to your hosts file
```txt
127.0.0.1       lmaoo.local
::1             lmaoo.local
```
> Note: If you are part of the OTAL Team, I will also provide QA and Staging endpoints on the discord server!

## Contributing
The OTAL team is only allowed to modify code for this project. Applicants are more than welcome to join the team! Create a issue with your email address and I will contact you.

## License
MIT
