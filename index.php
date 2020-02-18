<?php

require_once('common/common.php');

try {

  $dbh = connectDB();

  $sql = 'select id, name, price from product where 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  echo '・商品一覧<br>';

  while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo <<<EOD
      <a href="shop/shop_product.php?pro_code=$rec[id]">
        $rec[name] : $rec[price] 円 
      </a><br>
EOD;
  }

  echo '<a href="shop/shop_cartlook.php">カート詳細へ</a><br>';
  echo '<a href="staff/staff_login.php">ログインする</a><br>';

} catch (Exception $e) {
  echo '何かしらのエラーが発生しています';
  echo $e->getMessage();
  exit();
}
