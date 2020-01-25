<?php

require_once('../common/common.php');

try {

  $staff_name = $_POST['name'];
  $staff_pass = $_POST['pass'];

  $dbh = connectDB();

  $sql = 'insert into staff (name, password) values (?, ?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_name;
  $data[] = $staff_pass;
  $stmt->execute($data);

  $dbh = null;

  session_start();
  $_SESSION['login'] = 1;
  $_SESSION['staff_name'] = $post['name'];
  echo $staff_name . ' の登録が完了しました.';
} catch (Exception $e) {
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  echo $e->getMessage();
  exit();
}

echo '<a href="../product/pro_list.php">商品一覧ページへ</a>';
