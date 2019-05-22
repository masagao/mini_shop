<?php

require_once('../common/common.php');

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

$pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);

$dbh = connectDB();

$sql = 'select name, price, image from mst_product where id=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name = $rec['name'];
$pro_price = $rec['price'];
$pro_image = $rec['image'];

$dbh = null;

if ($pro_image == '') {
  $desc_image = '';
} else {
  $desc_image = 'product image : <br>' . '<image width="150" src="../product/image/'.$pro_image.'">';
}

echo '<a href="shop_cartin.php?pro_code='.$pro_code.'">Take into the cart</a><br>';

}catch(Exeption $e) {

  echo 'I am sorry but something might be wrong on this server..';
  exit();

}

?>
  The imfomation of product.<br>
  product id : <?php echo $pro_code; ?>
  <br>
  product name : <?php echo $pro_name; ?>
  <br>
  product price : <?php echo $pro_price; ?>
  <br>
  <?php echo $desc_image?>
  <br>
  <input type="button" onclick="history.back()" value="Back">
</body>
</html>
