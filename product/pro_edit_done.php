<?php

require_once('../common/common.php');

try {
  $post = sanitize($_POST);

  $pro_code = $post['id'];
  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_image_name_old = $post['image_name_old'];
  $pro_image_name = $post['image_name'];

  $dbh = connectDB();

  $sql = 'update mst_product set name=?, price=?, image=? where id=?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_name;
  $data[] = $pro_price;
  $data[] = $pro_image_name;
  $data[] = $pro_code;
  $stmt->execute($data);

  $dbh = null;

  if ($pro_image_name_old != $pro_image_name) {
    if ($pro_image_name_old != ''){
      unlink('./image/'.$pro_image_name_old);
    }
  }

  echo $pro_name .' は編集されました.<br>';
} catch(Exception $e){
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();
}

echo '<a href="pro_list.php">商品一覧ページへ</a>';