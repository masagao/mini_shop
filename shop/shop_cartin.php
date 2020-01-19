<?php

require_once('../common/common.php');

session_start();
session_regenerate_id(true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shop</title>
</head>
<body>
<?php

try {

$pro_code = $_GET['pro_code'];

if(isset($_SESSION['cart'])){
  $cart = $_SESSION['cart'];
  $kazu = $_SESSION['kazu'];
  if(in_array($pro_code, $cart) == true) {
    echo 'この商品はすでにカートに入っています。
          <br>
          <a href="../index.php">ショップリストに戻る</a>';
    exit();
  }
}

$cart[] = $pro_code;
$kazu[] = 1;
$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;

}catch(Exeption $e) {

  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();

}

?>

カートに追加しました。<br>
<a href="../index.php">商品一覧に戻る</a>
</body>
</html>
