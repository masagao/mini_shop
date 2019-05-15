<?php

require_once('../common/common.php');

try {
  $post = sanitize($_POST);

  $pro_code = $post['id'];
  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_gazou_name_old = $post['gaou_name_old'];
  $pro_gazou_name = $post['gazou_name'];

  $dbh = connectDB();

  $sql = 'update mst_product set name=?, price=?, gazou=? where id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_name;
  $data[] = $pro_price;
  $data[] = $pro_gazou_name;
  $data[] = $pro_code;
  $stmt->execute($data);

  $dbh = null;
  if ($pro_gazou_name_old != $pro_gazou_name) {
    if ($pro_gazou_name_old != ''){
      unlink('./gazou/'.$pro_gazou_name_old);
    }
  }

  echo $pro_name .' was edited.<br>';
} catch(Exception $e){
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}

echo '<a href="pro_list.php">Go to pro list</a>';