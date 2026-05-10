<?php

session_start();

require 'db.php';
$sql = "SELECT posts.*, users.username FROM posts
JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <?php if(isset($_SESSION['user_id'])):?>
    <div>已登入</div>
    <a href="create.php">發文</a>
    <a href="logout.php">登出</a>
  <?php else:?>
    <div>未登入</div>
    <a href="login.php">登入</a>
    <a href="register.php">註冊</a>
  <?php endif;?>
  <?php foreach ($posts as $post): ?>
      <div>
          <h2>
            <a href="post.php?id=<?= $post['id'] ?>">
              <?= htmlspecialchars($post['title']) ?>
            </a>
          </h2>
          <p>作者：<?= $post['username'] ?></p>
      </div>
  <?php endforeach; ?>
</body>
</html>