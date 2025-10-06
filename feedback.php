<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$fio = trim($data['fio'] ?? '');
$email = trim($data['email'] ?? '');
$message = trim($data['message'] ?? '');

$errors = false;
$fio = trim(htmlspecialchars(strip_tags($data['fio'] ?? ''), ENT_QUOTES, 'UTF-8'));
$email = trim(htmlspecialchars(strip_tags($data['email'] ?? ''), ENT_QUOTES, 'UTF-8'));
$message = trim(htmlspecialchars(strip_tags($data['message'] ?? ''), ENT_QUOTES, 'UTF-8'));

if ($errors) {
    echo json_encode(['success' => false, 'message' => "Ошибка валидации"]);
    exit;
}

require './php/config/config.php';

try {
    $stmt = $pdo->prepare("INSERT INTO feedback (fio, email, message) VALUES (:fio, :email, :message)");
    $stmt->bindParam(':fio', $fio, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Спасибо! Ваше сообщение отправлено.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка базы данных: ' . $e->getMessage()]);
}
