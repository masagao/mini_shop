<?php

require_once('../common/common.php');

try {

  $post = sanitize($_POST);

  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_image_name = $post['image_name'];

  $dbh = connectDB();

  $sql = 'insert into mst_product (name, price, image) values (?, ?, ?)';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_name;
  $data[] = intval($pro_price);
  $data[] = $pro_image_name;
  $stmt->execute($data);

  $dbh = null;

  echo $pro_name .' was added in the database.<br>';

} catch(Exception $e){
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}

echo '<a href="pro_list.php">Go to product list</a>';