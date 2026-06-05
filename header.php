<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heaven's Kitchen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-nav">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Heaven's Kitchen</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="index.php#menu">Меню</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">За нас</a></li>
                <li class="nav-item"><a class="nav-link" href="cart.php">Количка <span class="badge bg-warning text-dark"><?= $cartCount ?></span></a></li>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <li class="nav-item"><span class="nav-link text-warning">Здравей, <?= htmlspecialchars($_SESSION['user_name']) ?></span></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="logout.php">Изход</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Вход</a></li>
                    <li class="nav-item"><a class="btn btn-warning btn-sm" href="register.php">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
