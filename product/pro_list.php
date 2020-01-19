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
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  echo '商品一覧<br>';

  echo '<form method="POST" action="pro_branch.php">';
  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <input type="submit" name="add" value="add">
    <input type="submit" name="detail" value="detail">
    <input type="submit" name="edit" value="edit">
    <input type="submit" name="delete" value="delete">
    <br>
    <a href="../staff/staff_logout.php">Logout:</a>
    </form>
EOD;
}
  catch(Exception $e) {
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  exit();
}