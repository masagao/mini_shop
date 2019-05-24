<?php

require_once('../common/common.php');

$post = sanitize($_POST);

$staff_name=$post['name'];
$staff_pass1=$post['pass1'];
$staff_pass2=$post['pass2'];

if ($staff_name == '') {
  echo 'Please input your name..<br>';
} elseif($staff_pass1 == '') {
  echo 'please set new password..<br>';
} elseif($staff_pass2 == '') {
  echo 'please enter the password again..<br>';
} elseif($staff_pass1 !== $staff_pass2) {
  echo 'You might take mistake in entering the password<br>';
} else {
  echo 'your name : '.$staff_name;
}

if ($staff_name == '' || $staff_pass1 == '' || $staff_pass1 !== $staff_pass2) {
  echo '<form>
          <input type="button" onclick="history.back()" value="Back">
        </form>';
} else {
  $staff_pass=md5($staff_pass1);
  echo '<form method="POST" action="staff_add_done.php">
        <input type="hidden" name="name" value="'.$staff_name.'">
        <input type="hidden" name="pass" value="'.$staff_pass.'">
        <br>
        <input type="button" onclick="history.back()" value="Back">
        <input type="submit" value="OK">
        </form>';
}