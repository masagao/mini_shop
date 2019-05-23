<?php

require_once('common/common.php');

try{

  $dbh = connectDB();

  $sql = 'select id, name, price from mst_product where 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  echo 'product list<br>';

  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo '<a href="shop/shop_product.php?pro_code='.$rec[id].'">',
          $rec['name']
          . ' : ' .
          $rec['price'].' JPY </a><br>';
  }

  echo '<a href="shop/shop_cartlook.php">look into the cart</a><br>';
  echo '<a href="staff/staff_login.php">login</a><br>';
} catch(Exception $e) {
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}