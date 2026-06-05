<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart'])) {
    foreach ($_POST['quantities'] as $foodId => $quantity) {
        $quantity = (int)$quantity;
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$foodId]);
        } else {
            $_SESSION['cart'][$foodId]['quantity'] = $quantity;
        }
    }
}

header('Location: cart.php');
exit;
?>
