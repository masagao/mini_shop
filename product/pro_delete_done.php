<?php

require_once('../common/common.php');

try {
  $pro_code = $_POST['id'];
  $pro_gazou_name = $_POST['gazou_name'];

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

  if ($pro_gazou_name != '') {
    unlink('./image/'.$pro_gazou_name);
  }

  echo $pro_name .' was deleted.';
} catch(Exception $e){
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}

echo '<a href="pro_list.php">Go to product list</a>';