<!DOCTYPE html>
<html lang="ja">

<body>

  <?php
  require_once('../common/common.php');

  try {
    $pro_code = $_GET['pro_code'];
    $pro_code = htmlspecialchars($pro_code, ENT_QUOTES, 'UTF-8');

    $dbh = connectDB();

    $sql = 'select name, image from product where id=?';
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
      $desc_image = '商品画像 : <br><img width="100" src="./image/' . $pro_image_name . '">';
    }
  } catch (Exeption $e) {
    echo 'ただいま障害により大変ご迷惑をおかけしております..';
    echo $e->getMessage();
    exit();
  }
  ?>

  ・商品の削除<br>
  商品名 : <?php echo $pro_name; ?>
  <br>
  <?php echo $desc_image; ?>
  <?php echo 'この商品を削除しますか ?' ?>
  <form method="POST" action="pro_delete_done.php">
    <input type="hidden" name="id" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="image_name" value="<?php echo $pro_image_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="削除する">
  </form>

</body>

</html>