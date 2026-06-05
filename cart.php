<?php
include 'includes/header.php';
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<div class="container page-wrap">
    <div class="cart-box">
        <h2 class="section-title mb-4">Твоята количка</h2>
        <?php if (empty($cart)): ?>
            <div class="alert alert-info">Количката е празна. <a href="index.php#menu">Виж менюто</a>.</div>
        <?php else: ?>
            <form action="update_cart.php" method="POST">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Храна</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Общо</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $item):
                                $lineTotal = $item['price'] * $item['quantity'];
                                $total += $lineTotal;
                            ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= number_format($item['price'], 2) ?> лв.</td>
                                    <td><input type="number" min="0" name="quantities[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" class="form-control" style="max-width: 100px;"></td>
                                    <td><?= number_format($lineTotal, 2) ?> лв.</td>
                                    <td><a href="remove_from_cart.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger">Премахни</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <button class="btn btn-outline-dark">Обнови количества</button>
                    <h4 class="mb-0">Крайна сума: <span class="price"><?= number_format($total, 2) ?> лв.</span></h4>
                </div>
            </form>
            <hr>
            <?php if (empty($_SESSION['user_id'])): ?>
                <div class="alert alert-warning">За да направиш поръчка, трябва да <a href="login.php">влезеш в профила си</a>.</div>
            <?php else: ?>
                <h4 class="mb-3">Данни за доставка</h4>
                <form action="checkout.php" method="POST" class="row g-3">
                    <div class="col-md-8"><input type="text" name="address" class="form-control" placeholder="Адрес за доставка" required></div>
                    <div class="col-md-4"><input type="text" name="phone" class="form-control" placeholder="Телефон" required></div>
                    <div class="col-12"><button class="btn btn-main btn-lg">Направи поръчка</button></div>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
