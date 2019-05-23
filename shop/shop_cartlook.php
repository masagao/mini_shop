<?php

require_once('../common/common.php');

session_start();
session_regenerate_id(true);

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

if(isset($_SESSION['cart']) == true) {
  $cart = $_SESSION['cart'];
  $kazu = $_SESSION['kazu'];
  $max = count($cart);
} else {
  $max = 0;
}

if($max == 0) {
  echo 'There are no items
        <br>
        <a href="../index.php">Back to shop list</a>';
  exit();
}

$dbh = connectDB();

foreach($cart as $key => $val) {
  $sql = 'select id, name, price, image from mst_product where id=?';
  $stmt = $dbh->prepare($sql);
  $data[0] = $val;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  $pro_name[] = $rec['name'];
  $pro_price[] = $rec['price'];
  if($rec['image'] == '') {
    $pro_gazou[] = '';
  } else {
    $pro_gazou[] = '<img width="150" src="../product/image/'.$rec['image'].'">';
  }
}

$dbh = null;

}catch(Exeption $e) {

  echo 'I am sorry but something might be wrong on this server..';
  exit();

}

?>
<br>

<form method="post" action="kazu_change.php">

<table border="1">
<tr>
<td>Product : </td>
<td>Image : </td>
<td>Price : </td>
<td>Count : </td>
<td>Total : </td>
<td>Delete : </td>

</tr>
<?php for($i=0; $i<$max; $i++) { ?>
  <tr>
    <td><?php echo $pro_name[$i]; ?></td>
    <td><?php echo $pro_gazou[$i]; ?></td>
    <td>Price : <?php echo $pro_price[$i]; ?> YEN</td>
    <td><input type="text" name="kazu<?php echo $i; ?>" value="<?php echo $kazu[$i]; ?>"></td>
    <td>Total price : <?php echo $pro_price[$i] * $kazu[$i]; ?> YEN</td>
    <td><input type="checkbox" name="sakujo<?php echo $i; ?>"></td>
  </tr>
<?php } ?>
</table>

<input type="hidden" name="max" value="<?php echo $max;?>">
<input type="submit" value="count_change">
</form>
<br>
<a href="../index.php">Back to shop list</a>
</body>
</html>
