# Mb webdev

## Installation

To run the page locally, you will need mysql and php (php 7.1.14 used). You can install xampp or laragon or something similar to create a local environment. Place all the contents in a "magebit" folder in the htdocs/document root. You should be able to open the page on localhost/magebit

Attatched is an SQL initation file (mbdb.sql), you can run it in your DB to get some sample data. The entered data can be viewed at localhost/magebit/subscribers.php or by pressing on the "about" section.

if you need to change DB details, you can do it at the top op Model.php

in php.ini make sure extension=php_pdo_mysql.dll is uncommented so that mysql works.


