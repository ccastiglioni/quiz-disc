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

unset($_SESSION['login']);
unset($_SESSION['admin_id']);
unset($_SESSION['coach_id']);
$_SESSION = array();
session_destroy();  
?>

