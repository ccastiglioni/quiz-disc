<?php
session_start(); 
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 
if (isset($_SESSION['coach_id'])) {
    header("location:coach"); 
}else{
    header("location:index"); 
}

$_SESSION = array();
unset($_SESSION['login']);
session_destroy();  
?>

