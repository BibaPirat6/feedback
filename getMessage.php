<?php
try {
  header('Content-Type: application/json');
  require './php/config/config.php';

  $stmt = $pdo->query("SELECT fio, email, message FROM feedback");
  $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($messages as &$message) {
    $message['fio'] = htmlspecialchars($message['fio'], ENT_QUOTES, 'UTF-8');
    $message['email'] = htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8');
    $message['message'] = htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8');
  }

  echo json_encode($messages);
} catch (PDOException $e) {
  echo json_encode(['error' => 'Ошибка базы данных']);
}
