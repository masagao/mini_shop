<?php

session_start();
$_SESSION = array();

if (isset($_COOKIE[session_name()]) == true) {
      setcookie(session_name(), '', time() - 42000, '/');
}

session_destroy();

echo <<<EOD
      カートを空にしました<br>
      <a href="../index.php">商品一覧に行く</a>
EOD;
