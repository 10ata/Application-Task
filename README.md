#Application Task

Before running the code, make sure to:
-run `composer install`
-change path in public folder, .htaccess file `RewriteBase /Tasks/ApplicationTask/public/` (line 4) to your own, leaving public suffix there.
-run the .sql from the root directory (db.sql)
-change MySQL config from src/configs/development/config.php




I have created one PHPUnit test and you can run it by executing `.\bin\phpunit tests` in root dir

This code was running under PHP 8 so I cannot guarantee that it will work on PHP < 8.

Thank you!