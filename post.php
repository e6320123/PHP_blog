<?php
session_start();

require 'db.php';
$id = $_GET['id']??null;

if (!$id) {
  header("Location:index.php");
  exit;
}

$sql = "SELECT posts.*, users.username FROM posts 
JOIN users ON posts.user_id = users.id
        WHERE posts.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
  header("Location:index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <title><?= $post['title'] ?></title>
</head>
<body>
  <h1><?= $post['title'] ?></h1>
  <p>作者：<?= $post['username'] ?>｜<?= $post['created_at'] ?></p>
  <p><?= nl2br($post['content']) ?></p>

  <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
    <a href="edit.php?id=<?= $post['id'] ?>">編輯</a>
    <a href="delete.php?id=<?= $post['id'] ?>">刪除</a>
  <?php endif; ?>
</body>
</html>