<?php

try {
  $pdo = new PDO('mysql:host=MySQL-8.2;dbname=db_feedbackData', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Ошибка подключения" . $e->getMessage());
}
