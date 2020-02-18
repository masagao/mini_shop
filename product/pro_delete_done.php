<?php

require_once('../common/common.php');

try {
  $pro_id = $_POST['id'];
  $pro_name = $_POST['name'];

  $dbh = connectDB();

  $sql = 'DELETE from product where id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_id;
  $stmt->execute($data);

  $dbh = null;

  echo $pro_name . ' を削除しました<br>';
} catch (Exception $e) {
  echo '何かしらのエラーが発生しています';
  echo $e->getMessage();
  exit();
}

echo '<a href="pro_list.php">商品一覧へ</a>';
