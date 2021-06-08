<!DOCTYPE html>
<html lang="ja">

<body>

  <?php
  require_once('../common/common.php');

  try {
    $pro_id = $_GET['pro_code'];
    $pro_id = htmlspecialchars($pro_id, ENT_QUOTES, 'UTF-8');

    $dbh = connectDB();

    $sql = 'select name, price, image from product where id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_id;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_price = $rec['price'];
    $pro_image_name = $rec['image'];

    $dbh = null;

    if ($pro_image_name == '') {
      $image = '';
    } else {
      $image = '<img width="100" src="./images/' . $pro_image_name . '"><br>';
    }
  } catch (Exception $e) {
    echo '何かしらのエラーが発生しています';
    echo $e->getMessage();
    exit();
  }

  ?>
  ・商品の編集<br>
  <form method="POST" action="pro_edit_check.php" enctype='multipart/form-data'>
    <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
    商品名を入力してください
    <input type="text" name="name" value="<?php echo $pro_name; ?>">
    <br>
    商品の価格を入力してください
    <input type="number" name="price" value="<?php echo $pro_price; ?>">
    <br>
    <?php echo $image; ?>
    商品の画像を選んでください
    <input type="file" name="image">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="確認">
  </form>

</body>

</html>
