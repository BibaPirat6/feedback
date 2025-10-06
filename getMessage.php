<?php

header('Content-Type: application/json');
require './php/config/config.php';

$stmt = $pdo->query("SELECT fio, email, message FROM feedback");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);
