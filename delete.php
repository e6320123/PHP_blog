<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id']??null;
if (!$user_id) {
  header("Location: index.php");
  exit;
}

$id = $_GET['id']??null;
if (!$id) {
  header("Location: index.php");
  exit;
}


$sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $user_id]);
header("Location: index.php");
exit;
?>