<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$staff_name=$post['name'];
$staff_pass1=$post['pass1'];
$staff_pass2=$post['pass2'];

if ($staff_name == '') {
  echo 'あなたのお名前を入力してください..<br>';
} elseif($staff_pass1 == '') {
  echo 'パスワードを入力してください..<br>';
} elseif($staff_pass2 == '') {
  echo '再度パスワードを入力してください..<br>';
} elseif($staff_pass1 !== $staff_pass2) {
  echo 'パスワードが一致しません<br>';
} else {
  echo 'あなたのお名前 : '.$staff_name;
}

if ($staff_name == '' || $staff_pass1 == '' || $staff_pass1 !== $staff_pass2) {
  echo '<form>
          <input type="button" onclick="history.back()" value="戻る">
        </form>';
} else {
  $staff_pass=md5($staff_pass1);
  echo '<form method="POST" action="staff_add_done.php">
        <input type="hidden" name="name" value="'.$staff_name.'">
        <input type="hidden" name="pass" value="'.$staff_pass.'">
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="登録する">
        </form>';
}