#Application Task

Before running the code, make sure to:<br>
-run `composer install`<br>
-add vhost entry to apache vhost configuration (I used XAMPP but you can use any other Web server with apache):<br>

`<VirtualHost *:80>`<br>
`    ServerAdmin stoyan.rachev.4@gmail.com`<br>
`    DocumentRoot "C:/xampp/htdocs/Tasks/ApplicationTask/public"`<br>
`    ServerName localhost`<br>
`    ErrorLog "logs/ApplicationTask-error.log"`<br>
`    CustomLog "logs/ApplicationTask-access.log" common`<br>
`</VirtualHost>`<br>

-change path in public folder, .htaccess file `RewriteBase /Tasks/ApplicationTask/public/` (line 4) to your own, leaving public suffix there.<br>
-run the .sql from the root directory (`db.sql`)<br>
-change MySQL config from `src/configs/development/config.php`<br>

Upon successful code deployment, you may now navigate to localhost (or the used domain for configuration)<br>
and you can login with the created user with email: `stoyan.rachev.4@gmail.com` and password `admin`<br>

Code functionalities could be improved my:<br>
-implementing a DB Cacher and DB Logger but I did not have time to implement it unfortunately.<br>
-implementing modules classes to help cleaning the code in the controllers for Models work (get, insert, upsert, format).<br>

I have created one PHPUnit test and you can run it by executing `.\vendor\bin\phpunit` in root dir<br>

This code was running under PHP 8 so I cannot guarantee that it will work on PHP < 8.<br>

Thank you!