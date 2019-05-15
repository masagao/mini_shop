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

$dsn = 'mysql:dbname=shop; host=localhost; charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'select name, gazou from mst_product where code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$pro_name = $rec['name'];
$pro_gazou_name = $rec['gazou'];

$dbh = null;

if ($pro_gazou_name == '') {
  $desc_gazou = '';
} else {
  $desc_gazou = '<img width="150" src="./gazou/'.$pro_gazou_name.'">';
}

} catch(Exeption $e) {

  echo 'I am sorry but something might be wrong on this server..';
  exit();

}

?>
  Delete product.<br>
  Product name : <?php echo $pro_name; ?>
  <br>
  Product image :
  <br>
  <?php echo $desc_gazou; ?>
  <br>
  <?php echo 'Do you want to delete this product ?'?>
  <form method="POST" action="pro_delete_done.php">
    <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="gazou_name" value="<?php echo $pro_gazou_name; ?>">
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
</body>
</html>
