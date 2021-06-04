<!DOCTYPE html>
<html lang="ja">

<body>

  <?php
  require_once('../common/common.php');

  try {
    $pro_id = $_GET['pro_code'];
    $pro_id = htmlspecialchars($pro_id, ENT_QUOTES, 'UTF-8');

    $dbh = connectDB();

    $sql = 'select name, image from product where id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_id;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_image_name = $rec['image'];

    $dbh = null;

    if ($pro_image_name == '') {
      $image = '';
    } else {
      $image = '<img width="100" src="./image/' . $pro_image_name . '"><br>';
    }
  } catch (Exception $e) {
    echo '何かしらのエラーが発生しています';
    echo $e->getMessage();
    exit();
  }
  ?>

  ・商品の削除<br>
  商品名 : <?php echo $pro_name; ?>
  <br>
  商品画像 :
  <br>
  <?php echo $image; ?>
  この商品を削除しますか?
  <form method="POST" action="pro_delete_done.php">
    <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
    <input type="hidden" name="name" value="<?php echo $pro_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="削除する">
  </form>

</body>

</html>
