<?php

require_once('../common/common.php');

try {
  $pro_code = $_POST['id'];
  $pro_image_name = $_POST['image_name'];

  $dbh = connectDB();

  $sql = 'SELECT name from product where id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name = $rec['name'];

  $sql = 'DELETE from product where id=?';
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $dbh = null;

  echo $pro_name . ' を削除しました<br>';

} catch (Exception $e) {
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  echo $e->getMessage();
  exit();
}

echo '<a href="pro_list.php">商品一覧へ</a>';

