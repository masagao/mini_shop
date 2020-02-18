<!DOCTYPE html>
<html lang="ja">

<body>
  <?php

  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);

  try {

    if (isset($_SESSION['cart']) == true) {
      $cart = $_SESSION['cart'];
      $pro_count = count($cart);
    } else {
      $pro_count = 0;
    }

    if ($pro_count == 0) {
      echo 'カートには何も入っていません
        <br>
        <a href="../index.php">商品一覧に戻る</a>';
      exit();
    }

    $dbh = connectDB();
    $sql = 'select name, price, image from product where id=?';
    $stmt = $dbh->prepare($sql);

    foreach ($cart as $pro_id) {
      $data[0] = $pro_id;
      $stmt->execute($data);

      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      $pro_name[] = $rec['name'];
      $pro_price[] = $rec['price'];
      if ($rec['image'] == '') {
        $pro_gazou[] = '';
      } else {
        $pro_gazou[] = '<img width="50" src="../product/image/' . $rec['image'] . '">';
      }
    }

    $dbh = null;
  } catch (Exeption $e) {
    echo '何かしらのエラーが発生しています';
    echo $e->getMessage();
    exit();
  }
  ?>

  <?php for ($i = 0; $i < $pro_count; $i++) { ?>
    <div style="display: grid;">
      ・<?php echo $pro_name[$i]; ?> :
      <?php echo $pro_price[$i]; ?> 円 :
      <?php echo $pro_gazou[$i]; ?>
    </div>
  <?php } ?>
  <a href="shop_cartclear.php">カートを空にする</a>
  <br>
  <a href="../index.php">商品一覧に戻る</a>
</body>

</html>