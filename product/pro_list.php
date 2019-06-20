<?php

require_once('../common/common.php');
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) == false) {
  echo 'You did not login
       <br>
       <a href="../staff/staff_login.html">Go to login page</a>';
       exit();
} else {
  echo $_SESSION['staff_name'].' is login now<br>';
}

try{

  $dbh = connectDB();

  $sql = 'select id, name, price from mst_product where 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  echo 'product list<br>';

  echo '<form method="POST" action="pro_branch.php">';
  while(true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec == false) {
      break;
    }
    echo <<<EOD
    <input type="radio" name="pro_code" value="$rec[id]">
    $rec[name]:$rec[price]JPY
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
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}