<?php
session_start();
require_once 'includes/db.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$address = trim($_POST['address'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if ($address === '' || $phone === '') {
    header('Location: cart.php');
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

$pdo->beginTransaction();
try {
    $stmt = $pdo->prepare('INSERT INTO orders (user_id, total, address, phone) VALUES (?, ?, ?, ?)');
    $stmt->execute([$_SESSION['user_id'], $total, $address, $phone]);
    $orderId = $pdo->lastInsertId();

    $itemStmt = $pdo->prepare('INSERT INTO order_items (order_id, food_id, quantity, price) VALUES (?, ?, ?, ?)');
    foreach ($_SESSION['cart'] as $item) {
        $itemStmt->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
    }

    $pdo->commit();
    unset($_SESSION['cart']);
    header('Location: order_success.php?id=' . $orderId);
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    die('Грешка при поръчката: ' . $e->getMessage());
}
?>
