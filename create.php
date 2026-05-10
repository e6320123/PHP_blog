<?php
session_start();
require 'db.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $title = trim($_POST['title']);
  $content = $_POST['content'];
  if (empty($title) || empty($content)) {
    $error = '所有欄位都必須填寫';
  } else {
    $sql = 'insert into posts (user_id, title, content) values(?,?,?)';
    $stmt = $pdo->prepare($sql);
    try {
      $stmt->execute([$user_id, $title, $content]);
      $success = '發文成功！';
    } catch (PDOException $e) {
      $error = 'error';
    }
  }
  header("Location: index.php");
  exit;
}

?>

<?php if(isset($_SESSION['user_id'])):?>
  <div>已登入</div>
  <div>發文頁面</div>
  <form action="" method="post">
    <input type="text" name="title" id="">
    <br>
    <textarea name="content" id=""></textarea>
    <br>
    <input type="submit" value="發文">
  </form>
<?php else:?>
  <div>未登入</div>
  <a href="login.php">登入</a>
  <a href="register.php">註冊</a>
<?php endif;?>