<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_gazou = $_FILES['gazou'];

if ($pro_name == '') {
  echo 'Please input product name..<br>';
} elseif (preg_match('/^[0-9]+$/',$pro_price) == 0) {
  echo 'please input correct product price..<br>';
} else {
  echo 'Product name : '.$pro_name
        . '<br>' .
       'Product price : '.$pro_price .' JPY'
        . '<br>';
}

if ($pro_gazou['size'] > 0) {
  if ($pro_gazou['size'] > 1000000) {
    echo 'Image size is too large..';
  } else {
    move_uploaded_file($pro_gazou['tmp_name'], './gazou/'.$pro_gazou['name']);
    echo '<img width="150" src="./gazou/'.$pro_gazou['name'].'"><br>';
  }
}

if ($pro_name == '' || preg_match('/^[0-9]+$/',$pro_price) == 0 || $pro_gazou['size'] > 1000000) {
echo <<<EOD
  <form>
    <input type="button" onclick="history.back()" value="Back">
  </form>
EOD;
} else {
echo <<<EOD
  <form method="POST" action="pro_add_done.php">
    <input type="hidden" name="name" value="$pro_name">
    <input type="hidden" name="price" value="$pro_price">
    <input type="hidden" name="gazou_name" value="$pro_gazou[name]">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
EOD;
}