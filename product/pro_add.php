<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shop</title>
</head>
<body>
  Add Products.
  <form method="POST" action="pro_add_check.php" enctype='multipart/form-data'>
    input product name.
    <input type="text" name="name">
    <br>
    input product price.
    <input type="text" name="price">
    <br>
    input picture.
    <input type="file" name="gazou">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
</body>
</html>