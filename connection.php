<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include 'admin/includes/host.php';

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
 

$dbh = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME ) or die("could not connect" . mysqli_error($dbh) ) ;

?>
