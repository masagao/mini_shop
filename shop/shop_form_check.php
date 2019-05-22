<body>
  <?php
  require_once('../common/common.php');

  $post = sanitize($_POST);

  $onamae = $post['onamae'];
  $email = $post['email'];
  $postal1 = $post['postal1'];
  $postal2 = $post['postal2'];
  $address = $post['address'];
  $tel = $post['tel'];

  $okflug = true;

  if($onamae == '') {
    echo 'No name is entered<br>';
    $okflug = false;
  } else {
    echo 'name :'. $onamae .'<br>';
  }

  if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0) {
    echo 'Email is incorrected<br>';
    $okflug = false;
  } else {
    echo 'email : '. $email .'<br>';
  }

  if(preg_match('/\A[0-9]+\z/', $postal1) == 0) {
    echo 'Postal is incorrected<br>';
    $okflug = false;
  } else {
    echo 'postal : '. $postal1 .'-'. $postal2 .'<br>';
  }

  if(preg_match('/\A[0-9]+\z/', $postal2) == 0) {
    echo 'Postal is incorrected<br>';
    $okflug = false;
  }

  if($address == '') {
    echo 'No address is entered<br>';
    $okflug = false;
  } else {
    echo 'address : '. $address .'<br>';
  }

  if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0) {
    echo 'Phone number is incorrected<br>';
    $okflug = false;
  } else {
    echo 'phone number : '. $tel .'<br>';
  }

  if($okflug == false) {
    echo '<form>
    <input type="button" onclick="history.back()" value="Back">
    </form>';
  } else {
    echo '<form method="post" action="shop_form_done.php">
      <input type="hidden" name="onamae" value="'.$onamae.'">
      <input type="hidden" name="email" value="'.$email.'">
      <input type="hidden" name="postal1" value="'.$postal1.'">
      <input type="hidden" name="postal2" value="'.$postal2.'">
      <input type="hidden" name="address" value="'.$address.'">
      <input type="hidden" name="tel" value="'.$tel.'">
      <input type="button" onclick="history.back()" value="Back">
      <input type="submit" value="Ok">
      <br>
      </form>';
  }
  ?>
</body>