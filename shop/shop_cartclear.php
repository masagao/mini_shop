<?php

session_start();
$_SESSION = array();

session_destroy();

echo 'Cart has cleared<br>
      <a href="../index.php">Go to shop list</a>';