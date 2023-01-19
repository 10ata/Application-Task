#Application Task

Before running the code, make sure to:
-run `composer install`
-add vhost entry to apache vhost configuration (I used XAMPP but you can use any other Web server with apache)
`<VirtualHost *:80>
    ServerAdmin stoyan.rachev.4@gmail.com
    DocumentRoot "C:/xampp/htdocs/Tasks/ApplicationTask/public"
    ServerName localhost
    ErrorLog "logs/ApplicationTask-error.log"
    CustomLog "logs/ApplicationTask-access.log" common
</VirtualHost>`
-change path in public folder, .htaccess file `RewriteBase /Tasks/ApplicationTask/public/` (line 4) to your own, leaving public suffix there.
-run the .sql from the root directory (db.sql)
-change MySQL config from src/configs/development/config.php


Code functionalities could be improved my:
-implementing a DB Cacher but I did not have time to implement it unfortunately.
-implementing modules classes to help cleaning the code in the controllers for Models work (get, insert, upsert, format).

I have created one PHPUnit test and you can run it by executing `.\vendor\bin\phpunit` in root dir

This code was running under PHP 8 so I cannot guarantee that it will work on PHP < 8.

Thank you!