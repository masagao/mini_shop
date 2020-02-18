<?php

require_once('../common/common.php');

try {

  $post = sanitize($_POST);

  $staff_name = $post['name'];
  $staff_pass = md5($post['pass']);

  $dbh = connectDB();

  $sql = 'SELECT id from staff where name=? AND password=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $dbh = null;

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($rec == false) {
    echo 'お名前、またはパスワードの入力に間違いがあります
       <br>
       <a href="staff_login.php">戻る</a>';
  } else {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['staff_name'] = $rec['name'];
    header('Location:../product/pro_list.php');
    exit();
  }
} catch (Exception $e) {
  echo '何かしらのエラーが発生しています';
  echo $e->getMessage();
  exit();
}
