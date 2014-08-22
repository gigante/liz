# Liz

Intends to be a useful way to turn structure of small projects to an MVC architecture with a front Controller. Simple and small objective

## Install

### Install Composer

> Execute: `curl -s https://getcomposer.org/installer | php`

> Execute: `php composer.phar install`
    
### Setup htaccess

create file ".htaccess" in the root project with this content

    <IfModule mod_rewrite.c>
    	RewriteEngine On
    	RewriteCond %{REQUEST_FILENAME} -s [OR]
    	RewriteCond %{REQUEST_FILENAME} -l [OR]
    	RewriteCond %{REQUEST_FILENAME} !-d
    	RewriteCond %{REQUEST_FILENAME} !-f
    	RewriteRule ^.*$ - [NC,L]
    	RewriteRule !\.(js|ico|gif|jpg|png|css|htm|html|txt|mp3)$ index.php [NC,L]
    </IfModule>

### Requirements

    1. PHP 5.3+
    2. Enable mod_rewrite (apache)