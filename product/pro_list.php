<?php

require_once('../common/common.php');
// session_start();
// session_regenerate_id(true);
// if (isset($_SESSION['login']) == false) {
//   echo 'ログインしていません
//        <br>
//        <a href="../staff/staff_login.php">ログインページへ</a>';
//   exit();
// } else {
//   echo $_SESSION['staff_name'] . ' はログイン中です<br>';
// }

try {

  $dbh = connectDB();

  $sql = 'select id, name, price from product where 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  echo <<<EOD
    ・商品一覧<br>
    <form method="POST" action="pro_branch.php">
EOD;
  while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo <<<EOD
      <input type="radio" name="pro_code" value="$rec[id]">
      $rec[name] : $rec[price]円
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
} catch (Exception $e) {
  echo 'ただいま障害により大変ご迷惑をおかけしております..';
  echo $e->getMessage();
  exit();
}
