<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_image = $_FILES['image'];

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

if ($pro_image['size'] > 0) {
  if ($pro_image['size'] > 1000000) {
    echo 'Image size is too large..';
  } else {
    move_uploaded_file($pro_image['tmp_name'], './image/'.$pro_image['name']);
    echo '<img width="150" src="./image/'.$pro_image['name'].'"><br>';
  }
}

if ($pro_name == '' || preg_match('/^[0-9]+$/',$pro_price) == 0 || $pro_image['size'] > 1000000) {
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
    <input type="hidden" name="image_name" value="$pro_image[name]">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
EOD;
}