<?php

require_once('../common/common.php');

try {
  $pro_code = $_POST['id'];
  $pro_image_name = $_POST['image_name'];

  $dbh = connectDB();

  $sql = 'SELECT name from mst_product where id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name = $rec['name'];

  $sql = 'DELETE from mst_product where id=?';
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  $dbh = null;

  if ($pro_image_name != '') {
    unlink('./image/'.$pro_image_name);
  }

  echo $pro_name .' was deleted.';
} catch(Exception $e){
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();
}

echo '<a href="pro_list.php">Go to product list</a>';