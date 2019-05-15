<!DOCTYPE html>
<html lang="ja">
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
    <input type="file" name="image">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
</body>
</html>