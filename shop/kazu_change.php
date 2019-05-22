<?php
  session_start();
  session_regenerate_id(true);

  require_once('../common/common.php');

  $post = sanitize($_POST);

  $max = $post['max'];

  for($i = 0; $i < $max; $i++) {
    if(preg_match("/^[0-9]+$/", $post['kazu'.$i])==0) {
      echo 'It is only allowed to use number
            <br>
            <a href="shop_cartlook.php">Back to cart</a>';
      exit();
    } elseif($post['kazu'.$i] <=0 || $post['kazu'.$i] >= 11) {
      echo 'It is only allowed up to 1 to 10
            <br>
            <a href="shop_cartlook.php">Back to cart</a>';
      exit();
    }
    $kazu[] = $post['kazu'.$i];
  }

  $cart = $_SESSION['cart'];

  for($i = $max; 0 <= $i; $i--) {
    if(isset($_POST['sakujo'.$i])==true) {
      array_splice($cart, $i, 1);
      array_splice($kazu, $i, 1);
    }
  }

  $_SESSION['cart'] = $cart;
  $_SESSION['kazu'] = $kazu;

  header('Location:shop_cartlook.php');
  exit();

?>