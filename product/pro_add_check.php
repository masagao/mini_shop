<?php

require_once('../common/common.php');

$post = sanitize($_POST);
//$_POSTは前の画面でformで送信された入力データが詰まっている。中身を見るには['name']をつける。

$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_image = $_FILES['image'];

if ($pro_name == '') {
  echo '商品名を入力してください..<br>';
} elseif (preg_match('/^[0-9]+$/',$pro_price) == 0) {
  //== 0 はfalseだったらなので、0-9以外の文字が入っていたらという意味。
  echo '正しい金額を入力してください..<br>';
} else {
  //echo<<<EODは長い文字列を入力しますよという意味。EOD;で入力終了ですよという意味。
  echo <<<EOD
  商品名 : $pro_name
  <br>
  商品の価格 : $pro_price 円
  <br>
EOD;
}

// 画像の受け止め方
// $pro_image = $_FILES['image'];
// $pro_image['size'] 画像のサイズ、単位はバイト
// $pro_image['temp_name']　仮にアップロードされている画像本体の場所と名前
// $pro_image['name']　画像のファイル名


if ($pro_image['size'] > 0) {
  if ($pro_image['size'] > 1000000) {
    // １メガバイト
    echo '画像サイズが大きすぎます..';
  } else {
    move_uploaded_file($pro_image['tmp_name'], './image/'.$pro_image['name']);
    echo '<img width="150" src="./image/'.$pro_image['name'].'"><br>';
  }
}

// 画像の移動方法
// move_uploaded_file(移動元、移動先);
// [/]フォルダの区切り
// [.]プログラムと同じフォルダ
// [..]1段上のフォルダ

if ($pro_name == '' || preg_match('/^[0-9]+$/',$pro_price) == 0 || $pro_image['size'] > 1000000) {
echo <<<EOD
  <form>
    <input type="button" onclick="history.back()" value="戻る">
  </form>
EOD;
} else {
echo <<<EOD
  <form method="POST" action="pro_add_done.php">
    <input type="hidden" name="name" value="$pro_name">
    <input type="hidden" name="price" value="$pro_price">
    <input type="hidden" name="image_name" value="$pro_image[name]">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="追加する">
  </form>
EOD;
}
// hiddenにすることでユーザーの操作を回避できる。
