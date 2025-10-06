<?php

try {
  $pdo = new PDO('mysql:host=MySQL-8.0;dbname=db_feedback', 'root', '');
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Ошибка подключения к базе: ' . $e->getMessage()]);
  exit;
}
