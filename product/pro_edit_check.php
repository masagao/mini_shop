<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$pro_id = $post['id'];
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_image = $_FILES['image'];

if ($pro_name == '') {
  echo '商品名を入力してください..<br>';
} elseif (preg_match('/^[0-9]+$/', $pro_price) == 0) {
  echo '正しい価格を入力してください..<br>';
} else {
  echo <<<EDO
  商品名 : $pro_name
  <br>
  価格 : $pro_price 円
  <br>
EDO;
}

if ($pro_image['size'] > 0) {
  if ($pro_image['size'] > 1000000) {
    echo '画像サイズが大きすぎます..';
  } else {
    move_uploaded_file($pro_image['tmp_name'], './images/' . $pro_image['name']);
    echo '<img width="100" src="./images/' . $pro_image['name'] . '"><br>';
  }
}

if ($pro_name == '' || preg_match('/^[0-9]+$/', $pro_price) == 0 || $pro_image['size'] > 1000000) {
  echo <<<EDO
  <form>
    <input type="button" onclick="history.back()" value="戻る">
  </form>
EDO;
} else {
  echo <<<EDO
  <form method="POST" action="pro_edit_done.php">
    <input type="hidden" name="id" value="$pro_id">
    <input type="hidden" name="name" value="$pro_name">
    <input type="hidden" name="price" value="$pro_price">
    <input type="hidden" name="image_name" value="$pro_image[name]">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="変更する">
  </form>
EDO;
}
