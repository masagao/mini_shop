<?php
  session_start();
  session_regenerate_id(true);
?>

<body>
  <?php

    try {
      require_once('../common/common.php');

      $post = sanitize($_POST);

      $onamae = $post['onamae'];
      $email = $post['email'];
      $postal1 = $post['postal1'];
      $postal2 = $post['postal2'];
      $address = $post['address'];
      $tel = $post['tel'];

      echo 'Thank you for your ordering! '. $onamae
          .'<br>Certificate email has sent to '. $email
          .'<br>The item will sent to '. $postal1 .'-'. $postal2
          .'<br>'. $address
          .'<br>'. $tel
          .'<br>';

      $honbun = '';
      $honbun .= $onamae." 様 \n\n この度はご注文ありがとうございました \n";
      $honbun .= "\n";
      $honbun .= "ご注文商品 \n";
      $honbun .= "----------------------------------------------- \n";

      $cart = $_SESSION['cart'];
      $kazu = $_SESSION['kazu'];
      $max = count($cart);

      $dbh = connectDB();

      for($i = 0; $i < $max; $i++) {
        $sql = 'select name, price from mst_product where id=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $cart[$i];
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $rec['name'];
        $price = $rec['price'];
        $kakaku = $price;
        $suryo = $kazu[$i];
        $shokei = $price * $suryo;

        $honbun .= $name.' ';
        $honbun .= $price.'YEN x';
        $honbun .= $suryo.'count =';
        $honbun .= $shokei."YEN \n";
      }

      $sql = 'lock tables dat_sales write, dat_sales_product write';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      $sql = 'insert into dat_sales (code_member, name, email, postal1, postal2, address, tel) values (?, ?, ?, ?, ?, ?, ?)';
      $stmt = $dbh->prepare($sql);
      $data = array();
      $data[] = 0;
      $data[] = $onamae;
      $data[] = $email;
      $data[] = $postal1;
      $data[] = $postal2;
      $data[] = $address;
      $data[] = $tel;
      $stmt->execute($data);

      $sql = 'select LAST_INSERT_ID()';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastcode = $rec['LAST_INSERT_ID()'];

      for($i = 0; $i < $max; $i++) {
        $sql = 'insert into dat_sales_product (code_sales, code_product, price, quantity) values (?, ?, ?, ?)';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $lastcode;
        $data[] = $cart[$i];
        $data[] = $kakaku[$i];
        $data[] = $kazu[$i];
        $stmt->execute($data);
      }

      $sql = 'unlock tables';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      $dbh = null;

      $honbun .= "送料は無料です。\n";
      $honbun .= "----------------------------------------------- \n";
      $honbun .= "\n";
      $honbun .= "代金は以下の口座にお振込ください\n";
      $honbun .= "ロクマル銀行 野菜視点 普通口座 1234567\n";
      $honbun .= "入金確認が取れ次第、梱包、発送させていただきます\n";
      $honbun .= "\n";
      $honbun .= "□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□\n";

      // echo nl2br($honbun);

      $title = 'ご注文ありがとうございます。';
      $header = 'From: bimi0370@gmail.com';
      $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
      mb_language('Japanese');
      mb_internal_encoding('UTF-8');
      mb_send_mail($email, $title, $honbun, $header);

      $title = 'お客様からご注文がありました。';
      $header = 'From:'. $email;
      $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
      mb_language('Japanese');
      mb_internal_encoding('UTF-8');
      mb_send_mail('bimi0370@gmail.com', $title, $honbun, $header);

      $_SESSION = array();

      if(isset($_COOKIE[session_name()]) == true){
        setcookie(session_name(), '', time() - 42000, '/');
      }

      session_destroy();

    } catch (Exception $e) {
      echo 'I am sorry but something might be wrong on this server..';
      exit();
    }
  ?>

  <a href="shop_list.php">Go to shop list</a>
</body>