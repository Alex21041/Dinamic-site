<?php
// setup.php — ЗАПУСТИТЬ ОДИН РАЗ, потом УДАЛИТЬ файл!
// Создаёт таблицу users и администратора admin / admin123

require 'connect.php';

// Создаём таблицу, если её нет
$pdo->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        login VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");

// Создаём админа (пароль хешируется — в базе он никогда не хранится открытым!)
$login = 'admin';
$pass  = password_hash('admin123', PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT IGNORE INTO users (login, password, email) VALUES (?, ?, ?)");
$stmt->execute([$login, $pass, 'admin@secureadmin.example']);

echo 'Готово! Таблица users создана, пользователь admin добавлен.<br>';
echo 'Логин: admin / Пароль: admin123<br>';
echo '<b>ТЕПЕРЬ УДАЛИ ЭТОТ ФАЙЛ (setup.php)!</b>';
