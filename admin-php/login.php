<?php
// login.php — вход в админ-панель
session_start();

// Уже вошёл? Сразу в админку
if (isset($_SESSION['user_id'])) {
    header('Location: admin.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'connect.php';

    $login = trim($_POST['login'] ?? '');
    $pass  = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT id, login, password FROM users WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login']   = $user['login'];
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход — SecureAdmin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Comfortaa', cursive; background: #f4f6f6; }
        .login-box {
            max-width: 380px;
            margin: 90px auto;
            background: #ffffff;
            padding: 32px;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(29, 122, 116, 0.15);
        }
        .login-box h1 { font-size: 1.4em; text-align: center; margin-bottom: 24px; color: #1d7a74; }
        .btn-admin { background: #1d7a74; color: #fff; width: 100%; }
        .btn-admin:hover { background: #155e59; color: #fff; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>SecureAdmin — вход</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Логин</label>
                <input type="text" name="login" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-admin">Войти</button>
        </form>

        <p class="mt-3 text-center"><a href="index.html">← на сайт</a></p>
    </div>
</body>
</html>
