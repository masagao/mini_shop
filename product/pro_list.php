<?php

require_once('../common/common.php');

try{

  $dbh = connectDB();

  $sql = 'select code, name, price from mst_product where 1';
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
    echo '<input type="radio" name="pro_code" value="'.$rec[code].'">',
          $rec['name']
          . ' : ' .
          $rec['price'].' JPY <br>';
  }
  echo '<input type="submit" name="add" value="add">
        <input type="submit" name="detail" value="detail">
        <input type="submit" name="edit" value="edit">
        <input type="submit" name="delete" value="delete">
        </form>';
} catch(Exception $e) {
  echo 'I am sorry but something might be wrong on this server..';
  exit();
}