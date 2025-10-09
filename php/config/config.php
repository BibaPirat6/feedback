<?php

try {
  $pdo = new PDO('mysql:host=MySQL-8.0;dbname=db_feedback', 'root', '');
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Ошибка подключения к базе: ' . $e->getMessage()]);
  exit;
}
