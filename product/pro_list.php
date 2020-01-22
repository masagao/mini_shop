<?php

require_once('../common/common.php');
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false) {
  echo 'ログインしていません
       <br>
       <a href="../staff/staff_login.html">ログインページへ</a>';
       exit();
} else {
  echo $_SESSION['staff_name'].' はログイン中です<br>';
}

try{

  $dbh = connectDB();

  $sql = 'select id, name, price from mst_product where 1';
  // select カラム from 〜から where1　1は「全て」という意味
  $stmt = $dbh->prepare($sql);
  $stmt->execute();//この段階で$stmtには全てのデータが入っている。
  $dbh = null;

  echo '商品一覧<br>';

  echo '<form method="POST" action="pro_branch.php">';
  //radioで選択されたデータをbranchに飛ばす。nameはpro_code
  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    //$stmtが有る限り$recに格納していく。
    if ($rec == false) {
      break;
    }
    echo <<<EOD
    <input type="radio" name="pro_code" value="$rec[id]">
    $rec[name]:$rec[price]円
    <br>
EOD;
  }
  echo <<<EOD
    <input type="submit" name="add" value="追加">
    <input type="submit" name="detail" value="詳細">
    <input type="submit" name="edit" value="編集">
    <input type="submit" name="delete" value="削除">
    <br>
    <a href="../staff/staff_logout.php">ログアウト:</a>
    </form>
EOD;
  //form閉じタグはここまであります。
}
  catch(Exception $e) {
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();
}
