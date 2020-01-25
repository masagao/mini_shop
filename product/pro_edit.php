<!DOCTYPE html>
<html lang="ja">

<body>

  <?php
  require_once('../common/common.php');

  try {
    $pro_code = $_GET['pro_code'];
    $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');

    $dbh = connectDB();

    $sql = 'select name, price, image from product where id=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name = $rec['name'];
    $pro_price = $rec['price'];
    $pro_image_name_old = $rec['image'];

    $dbh = null;

    if ($pro_image_name_old == '') {
      $desc_image = '';
    } else {
      $desc_image = '<img width="100" src="./image/' . $pro_image_name_old . '"><br>';
    }
  } catch (Exeption $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております..';
    echo $e->getMessage();
    exit();
  }

  ?>
  ・商品の編集<br>
  <form method="POST" action="pro_edit_check.php" enctype='multipart/form-data'>
    <input type="hidden" name="id" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="image_name_old" value="<?php echo $pro_image_name_old; ?>">
    商品名を入力してください
    <input type="text" name="name" value="<?php echo $pro_name; ?>">
    <br>
    商品の価格を入力してください
    <input type="number" name="price" value="<?php echo $pro_price; ?>">
    <br>
    <?php echo $desc_image; ?>
    商品の画像を選んでください
    <input type="file" name="image">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="確認">
  </form>

</body>

</html>