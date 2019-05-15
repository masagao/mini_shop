<?php

require_once('../common/common.php');

try {

  $post = sanitize($_POST);

  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_gazou_name = $post['gazou_name'];

  $dbh = connectDB();

  $sql = 'insert into mst_product (name, price, gazou) values (?, ?, ?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_name;
  $data[] = intval($pro_price);
  $data[] = $pro_gazou_name;
  $stmt->execute($data);

  $dbh = null;

  echo $pro_name .' was added in the database.<br>';

} catch(Exception $e){
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}

echo '<a href="pro_list.php">Go to product list</a>';