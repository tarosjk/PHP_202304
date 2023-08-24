<?php
try {
  // データベース接続
  $dsn = 'mysql:host=localhost;dbname=interplan_pizza;charset=utf8';
  $user = 'pizza';
  $pass = 'pizza';
  $option = [
    // 'エラーの扱い' => 'エラーをオブジェクトとして受け取る',
    // 'データの取得方法' => '連想配列'
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];

  $db = new PDO($dsn, $user, $pass, $option);
} catch (PDOException $e) {
  var_dump($e->getMessage());
}