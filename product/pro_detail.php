<?php

require_once('../common/common.php');

?>

<!DOCTYPE html>
<html lang="ja">
<body>
<?php

try {

$pro_code = $_GET['pro_code'];

$pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);

$dbh = connectDB();

$sql = 'select name, price, gazou from mst_product where code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name = $rec['name'];
$pro_price = $rec['price'];
$pro_gazou = $rec['gazou'];

$dbh = null;

if ($pro_gazou == '') {
  $desc_gazou = '';
} else {
  $desc_gazou = 'product image : <br>' . '<image width="150" src="./gazou/'.$pro_gazou.'">';
}

}catch(Exeption $e) {

  echo 'I am sorry but something might be wrong on this server..';
  exit();

}

?>
  The imfomation of product.<br>
  product code : <?php echo $pro_code; ?>
  <br>
  product name : <?php echo $pro_name; ?>
  <br>
  product price : <?php echo $pro_price; ?>
  <br>
  <?php echo $desc_gazou?>
  <br>
  <input type="button" onclick="history.back()" value="Back">
</body>
</html>
