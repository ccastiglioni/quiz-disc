<?php 
include 'host.php';


if ( getHost() == "localhost" ||  getHost() =="127.0.0.1" ||  getHost() =="www.cleber.com.br" ||  getHost() =="cleber.com.br"  ) {
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','120521');
    define('DB_NAME','php-kuiz');
}else{
    define('DB_HOST','sql307.epizy.com');
    define('DB_USER','epiz_26345211');
    define('DB_PASS','Psk2h5FQSl');
    define('DB_NAME','epiz_26345211_quiz');
}
 
try
{
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}
?>
