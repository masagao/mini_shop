<!DOCTYPE html>
<html lang="ja">

<body>
  商品追加ページ
  <form method="POST" action="pro_add_check.php" enctype='multipart/form-data'>
    商品名を入力してください
    <input type="text" name="name">
    <br>
    価格を入力してください
    <input type="number" name="price">
    <br>
    商品の画像を追加してください
    <input type="file" name="image">
    <br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="確定">
  </form>
</body>

</html>