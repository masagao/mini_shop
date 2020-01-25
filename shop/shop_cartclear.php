<?php

session_start();
$_SESSION = array();
session_destroy();

echo <<<EOD
      カートを空にしました<br>
      <a href="../index.php">商品一覧に行く</a>
EOD;
