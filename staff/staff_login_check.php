<?php

require_once('../common/common.php');

try {

$post = sanitize($_POST);

$staff_id = $post['id'];
$staff_pass = $post['pass'];

$staff_pass = md5($staff_pass);

$dbh = connectDB();

$sql = 'SELECT name from mst_staff where id=? AND password=?';
$stmt = $dbh->prepare($sql);
$data[] = $staff_id;
$data[] = $staff_pass;
$stmt->execute($data);

$dbh = null;

$rec = $stmt->fetch(PDO::FETCH_ASSOC);

if ($rec == false) {
  echo 'You should have took mistake in entering your ID or Password
       <br>
       <a href="staff_login.html">Back</a>';
} else {
  session_start();
  $_SESSION['login'] = 1;
  $_SESSION['staff_code'] = $staff_id;
  $_SESSION['staff_name'] = $rec['name'];
  header('Location:../product/pro_list.php');
  exit();
}

} catch(Exception $e) {

  die($e->getMessage());
  echo 'I am sorry but something might be wrong on this server..';
  exit();

}