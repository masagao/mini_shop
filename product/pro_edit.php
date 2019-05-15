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
$pro_gazou_name_old = $rec['gazou'];

$dbh = null;

if ($pro_gazou_name_old == '') {
  $desc_gazou = '';
} else {
  $desc_gazou = '<img width="150" src="./gazou/'.$pro_gazou_name_old.'"><br>';
}

}catch(Exeption $e) {

  echo 'I am sorry but something might be wrong on this server..';
  exit();

}

?>
  Edit Product.<br>
  Product code : <?php echo $pro_code; ?>
  <form method="POST" action="pro_edit_check.php" enctype='multipart/form-data'>
    <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="gazou_name_old" value="<?php echo $pro_gazou_name_old; ?>">
    Input product name.
    <input type="text" name="name" value="<?php echo $pro_name; ?>">
    <br>
    Input product price.
    <input type="number" name="price" value="<?php echo $pro_price; ?>">
    <br>
    <?php echo $desc_gazou; ?>
    Select product image.
    <input type="file" name="gazou">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
</body>
</html>
