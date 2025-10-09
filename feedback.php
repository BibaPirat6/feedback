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

$errors = [];

if (strlen($fio) < 3 || strlen($fio) > 50) {
    $errors[] = 'Поле ФИО доджно быть от 3 до 50 символов';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Укажите корректный Email';
}

if (strlen($message) < 10 || strlen($message) > 200) {
    $errors[] = 'Поле сообщения должно содержать от 10 до 200 символов';
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => $errors]);
    exit;
}

require './php/config/config.php';

try {
    $stmt = $pdo->prepare("INSERT INTO feedback (fio, email, message) VALUES (:fio, :email, :message)");
    $stmt->execute([
        ':fio' => $fio,
        ':email' => $email,
        ':message' => $message,
    ]);

    echo json_encode(['success' => true, 'message' => 'Спасибо! Ваше сообщение отправлено.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка базы данных: ' . $e->getMessage()]);
}
