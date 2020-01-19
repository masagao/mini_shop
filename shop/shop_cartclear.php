<?php

session_start();
$_SESSION = array();

session_destroy();

echo 'カートの中身を削除しました<br>
      <a href="../index.php">ショップリストに行く</a>';