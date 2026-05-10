<?php


require 'db.php';

$error = '';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($username) || empty($email) || empty($password)) {
    $error = '所有欄位都必須填寫';
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'insert into users (username, email, password) values(?,?,?)';
    $stmt = $pdo->prepare($sql);
    try {
      $stmt->execute([$username, $email, $password]);
      $success = '註冊成功！';
    } catch (PDOException $e) {
      $error = '此信箱已被註冊';
    }
  }
}

?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="username" id="">
    <br>
    <input type="email" name="email" id="">
    <br>
    <input type="password" name="password" id="">
    <br>
    <button type="submit">submit</button>
    <br>
    <?= $success ?><?=$error?>

</form>
</body>
</html>


