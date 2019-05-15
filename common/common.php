<?php

function sanitize($before) {
  foreach ($before as $key => $value) {
    $after[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }

  return $after;
}

function connectDB() {
  $dsn = 'mysql:dbname=shop; host=localhost; charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $dbh;
}