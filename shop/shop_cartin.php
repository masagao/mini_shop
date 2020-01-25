<!DOCTYPE html>
<html lang="ja">

<body>

  <?php

  require_once('../common/common.php');

  session_start();
  session_regenerate_id(true);

  try {
    $pro_code = $_GET['pro_code'];

    if (isset($_SESSION['cart'])) {
      $cart = $_SESSION['cart'];
      if (in_array($pro_code, $cart) == true) {
        echo 'この商品はすでにカートに入っています。
            <br>
            <a href="../index.php">商品一覧に戻る</a>';
        exit();
      }
    }

    $cart[] = $pro_code;
    $_SESSION['cart'] = $cart;
  } catch (Exeption $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております..';
    echo $e->getMessage();
    exit();
  }
  ?>

  カートに追加しました。<br>
  <a href="../index.php">商品一覧に戻る</a>
</body>

</html>