<?php
try {
  $pdo = new PDO('mysql:host=MySQL-8.2;dbname=db_feedbackData', 'root', '');
} catch (PDOException $e) {
  die("Ошибка подключения" . $e->getMessage());
}
