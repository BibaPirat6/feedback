<?php
require_once realpath(__DIR__ . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$hostname = $_ENV['DB_HOST'] ?? 'MySQL-8.0';
$dbname   = $_ENV['DB_NAME'] ?? 'db_feedback';
$username = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';

try {
  $pdo = new PDO("mysql:host={$hostname};dbname={$dbname}", $username, $password);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo json_encode(['success' => false, 'message' => 'Ошибка подключения к базе: ' . $e->getMessage()]);
  exit;
}
