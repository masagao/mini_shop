<?php
require_once('common/common.php');
try{
  $dbh = connectDB();
  $sql = 'select id, name, price from mst_product where 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $dbh = null;
  echo '商品リスト<br>';
  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo '<a href="shop/shop_product.php?pro_code='.$rec[id].'">',
          $rec['name']
          . ' : ' .
          $rec['price'].' 円 </a><br>';
  }
  echo '<a href="shop/shop_cartlook.php">カートの中を見る</a><br>';
  echo '<a href="staff/staff_login.html">ログイン</a><br>';
  
} catch(Exception $e) {
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();
}
