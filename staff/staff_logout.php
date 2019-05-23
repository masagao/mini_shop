<?php

session_start();
$_SESSION = array();

if(isset($_COOKIE[session_name()]) == true){
  setcookie(session_name(), '', time() - 42000, '/');
}

session_destroy();

echo 'You are logout<br>
      <a href="staff_login.html">Go to login page</a>';