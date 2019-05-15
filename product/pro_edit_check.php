<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$pro_code = $post['code'];
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_gazou_name_old= $post['gazou_name_old'];
$pro_gazou = $_FILES['gazou'];

if ($pro_name == '') {
  echo 'Please input product name..<br>';
} elseif(preg_match('/^[0-9]/+$', $pro_price)) {
  echo 'please input correct product price..<br>';
} else {
  echo <<<EDO
  Product name : $pro_name
  <br>
  Product price : $pro_price JPY
  <br>
EDO;
}

if ($pro_gazou['size'] > 0) {
  if ($pro_gazou['size'] > 1000000) {
    echo 'Image size is too large..';
  } else {
    move_uploaded_file($pro_gazou['tmp_name'], './gazou/'.$pro_gazou['name']);
    echo '<img width="150" src="./gazou/'.$pro_gazou['name'].'"><br>';
  }
}

if ($pro_name == '' || preg_match('/^[0-9]/+$', $pro_price) || $pro_gazou['size'] > 1000000) {
  echo <<<EDO
  <form>
    <input type="button" onclick="history.back()" value="Back">
  </form>
EDO;
} else {
  echo <<<EDO
  <form method="POST" action="pro_edit_done.php">
    <input type="hidden" name="code" value="$pro_code">
    <input type="hidden" name="name" value="$pro_name">
    <input type="hidden" name="price" value="$pro_price">
    <input type="hidden" name="gazou_name_old" value="$pro_gazou_name_old">
    <input type="hidden" name="gazou_name" value="$pro_gazou[name]">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
EDO;
}