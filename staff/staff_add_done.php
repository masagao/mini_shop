<?php

require_once('../common/common.php');

try {

  $post = sanitize($_POST);

  $staff_name = $post['name'];
  $staff_pass = $post['pass'];

  $dbh = connectDB();

  $sql = 'insert into mst_staff (name, password) values (?, ?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $dbh = null;

  session_start();
  $_SESSION['login'] = 1;
  $_SESSION['staff_name'] = $post['name'];
  echo $staff_name .' was added in the database.';

} catch(Exception $e){
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}

echo '<a href="../product/pro_list.php">Go to product list</a>';