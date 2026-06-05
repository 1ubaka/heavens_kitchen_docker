<?php include 'includes/header.php'; ?>
<div class="container page-wrap">
    <div class="cart-box text-center">
        <h2 class="section-title">Поръчката е приета!</h2>
        <p class="lead">Благодарим ти, че избра Heaven's Kitchen.</p>
        <p>Номер на поръчка: <strong>#<?= htmlspecialchars($_GET['id'] ?? '') ?></strong></p>
        <a href="index.php#menu" class="btn btn-main">Обратно към менюто</a>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
