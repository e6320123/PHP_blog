<?php



$db = 'blog';
$user = 'root';
$pwd = '';
$host = 'localhost';

try {

  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8",$user,$pwd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
  die("錯誤訊息： ".$e->getMessage());

}





?>