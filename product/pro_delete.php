<!DOCTYPE html>
<html lang="ja">
<body>
<?php

try {

$pro_code = $_GET['pro_code'];

$pro_code = htmlspecialchars($pro_code, ENT_QUOTES, UTF-8);

$dsn = 'mysql:dbname=shop; host=localhost; charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'select name, image from mst_product where id=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name = $rec['name'];
$pro_image_name = $rec['image'];

$dbh = null;

if ($pro_image_name == '') {
  $desc_image = '';
} else {
  $desc_image = '<img width="150" src="./image/'.$pro_image_name.'">';
}

} catch(Exeption $e) {

  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();

}

?>
  商品を削除する.<br>
  商品名 : <?php echo $pro_name; ?>
  <br>
  商品画像 :
  <br>
  <?php echo $desc_image; ?>
  <br>
  <?php echo 'この商品を削除しますか ?'?>
  <form method="POST" action="pro_delete_done.php">
    <input type="hidden" name="id" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="image_name" value="<?php echo $pro_image_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="削除する">
  </form>
</body>
</html>
