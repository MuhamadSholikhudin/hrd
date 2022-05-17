<?php 
/*
http://10.10.42.6:8080 => 23
http://10.10.40.190:8080 => 25
http://127.0.0.1:8000 => 22

*/

define("URL_WEB", "http://10.10.42.6:8080");
define("SUM_URL_WEB", 23);

define("URL_WEB", "10.10.40.190:8080");
define("SUM_URL_WEB", 25);

define("URL_WEB", "http://127.0.0.1:8080");
define("SUM_URL_WEB", 22);