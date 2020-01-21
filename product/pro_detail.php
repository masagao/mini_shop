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
  $desc_image = 'product image : <br>' . '<image width="150" src="./image/'.$pro_image.'">';
}

}catch(Exeption $e) {

  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();

}

?>
  商品の情報.<br>
  商品のID : <?php echo $pro_code; ?>
  <br>
  商品名 : <?php echo $pro_name; ?>
  <br>
  価格 : <?php echo $pro_price; ?>
  <br>
  <?php echo $desc_image?>
  <br>
  <input type="button" onclick="history.back()" value="戻る">
</body>
</html>
