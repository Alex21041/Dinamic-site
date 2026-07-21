<?php
// admin.php — админ-панель (только для вошедших)
session_start();

// Не вошёл? На страницу входа
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'connect.php';

// Для примера: список всех пользователей из базы
$users = $pdo->query("SELECT id, login, email FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ-панель — SecureAdmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Comfortaa', cursive; background: #f4f6f6; }
        .admin-header {
            background: #1d7a74;
            color: #fff;
            padding: 16px 0;
            margin-bottom: 30px;
        }
        .admin-header a { color: #fff; }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 m-0">SecureAdmin — панель управления</h1>
            <div>
                Привет, <b><?= htmlspecialchars($_SESSION['login']) ?></b> ·
                <a href="index.html">на сайт</a> ·
                <a href="logout.php">выйти</a>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="h5 mb-3">Пользователи</h2>
        <table class="table table-bordered bg-white">
            <thead class="table-light">
                <tr><th>ID</th><th>Логин</th><th>Email</th></tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['login']) ?></td>
                    <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="text-muted">Дальше сюда добавим управление контентом сайта: услуги, тексты, картинки.</p>
    </div>
</body>
</html>
