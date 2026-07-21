<?php
// connect.php — подключение к базе данных
// ⚠️ Проверь имя базы: у тебя в phpMyAdmin она называется dinamic-site
// Логин root без пароля — стандарт для Ampps на localhost

$host = 'localhost';
$dbname = 'dinamic_site';
$user = 'root';
$password = 'mysql';   // в Ampps пароль root по умолчанию: mysql (если не подходит — попробуй пустую строку '')

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Ошибка подключения к БД: ' . $e->getMessage());
}
