<?php
session_start();
require_once 'includes/db.php';

$foodId = (int)($_POST['food_id'] ?? 0);
$quantity = max(1, (int)($_POST['quantity'] ?? 1));

$stmt = $pdo->prepare('SELECT * FROM foods WHERE id = ?');
$stmt->execute([$foodId]);
$food = $stmt->fetch();

if ($food) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$foodId])) {
        $_SESSION['cart'][$foodId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$foodId] = [
            'id' => $food['id'],
            'name' => $food['name'],
            'price' => $food['price'],
            'quantity' => $quantity
        ];
    }
}

header('Location: cart.php');
exit;
?>
