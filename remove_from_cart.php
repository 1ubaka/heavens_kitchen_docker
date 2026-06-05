<?php
session_start();
$foodId = (int)($_GET['id'] ?? 0);
if (isset($_SESSION['cart'][$foodId])) {
    unset($_SESSION['cart'][$foodId]);
}
header('Location: cart.php');
exit;
?>
