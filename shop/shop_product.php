<!DOCTYPE html>
<html lang="ja">

<body>
  <?php

  require_once('../common/common.php');

  try {

    $pro_id = $_GET['pro_code'];
    $pro_id = htmlspecialchars($pro_id, ENT_QUOTES, 'UTF-8');

    $dbh = connectDB();

    $sql = 'select name, price, image from product where id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_id;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_price = $rec['price'];
    $pro_image = $rec['image'];

    $dbh = null;

    if ($pro_image == '') {
      $image = '';
    } else {
      $image = '商品画像 : <br><image width="100" src="../product/image/' . $pro_image . '"><br>';
    }
  } catch (Exeption $e) {
    echo '何かしらのエラーが発生しています';
    echo $e->getMessage();
    exit();
  }

  ?>
  ・商品情報<br>
  商品名 : <?php echo $pro_name; ?>
  <br>
  商品の価格 : <?php echo $pro_price; ?>
  <br>
  <?php echo $image ?>
  <a href="shop_cartin.php?pro_code=<?php echo $pro_id; ?>">カートに入れる</a>
  <br>
  <input type="button" onclick="history.back()" value="戻る">
</body>

</html>