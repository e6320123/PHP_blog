<?php
session_start();

require 'db.php';

$error = '';

$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  if (empty($email) || empty($password)) {
    $error = '所有欄位都必須填寫';
  } else {
    $sql = 'SELECT * FROM users WHERE email = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header('Location:index.php');
      exit();
    } else {
      $error = '信箱或密碼錯誤';
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
    <input type="email" name="email" id="">
    <br>
    <input type="password" name="password" id="">
    <br>
    <button type="submit">login</button>
    <br>
    <?= $success ?><?=$error?>

</form>
</body>
</html>


