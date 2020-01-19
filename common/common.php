<?php
function sanitize($post) {
  foreach ($post as $key => $value) {
    $sanitized_post[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    // htmlspecialcharsはweb用の安全対策。$valueに含まれる危険な文字をサニタイズして$sanitized_postに代入しています。
  }
  return $sanitized_post;
}
function connectDB() {
  $dsn = 'mysql:dbname=shop; host=localhost; charset=utf8';
  $user = 'root';
  $password = 'root';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $dbh;
}