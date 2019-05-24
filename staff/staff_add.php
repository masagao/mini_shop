<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shop</title>
</head>
<body>
  Add staff members.
  <form method="POST" action="staff_add_check.php">
    input your name.
    <input type="text" name="name">
    <br>
    set your new password.
    <input type="password" name="pass1">
    <br>
    set the password again.
    <input type="password" name="pass2">
    <br>
    <input type="button" onclick="history.back()" value="Back">
    <input type="submit" value="OK">
  </form>
</body>
</html>