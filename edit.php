<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
  header("Location:index.php");
  exit();
}

$id = $_GET['id']??null;
if (!$id) {
  header("Location:index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $id = $_POST['id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$title, $content, $id, $_SESSION['user_id']]);
  header('Location: post.php?id=' . $id);
  exit;
}

$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $_SESSION['user_id']]);
$post = $stmt->fetch();

if (!$post) {
  header("Location:index.php");
  exit();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <input name="id" type="hidden" value="<?=$post['id']?>">
    <input name="title" type="text" value="<?=$post['title']?>">
    <br>
    <textarea name="content" id=""><?=$post['content']?></textarea>
    <button type="submit">submit</button>
  </form>
</body>
</html>
