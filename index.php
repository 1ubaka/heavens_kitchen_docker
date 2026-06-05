<?php
require_once 'includes/db.php';
include 'includes/header.php';
$foods = $pdo->query('SELECT * FROM foods ORDER BY id')->fetchAll();
?>
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-card">
                    <h1 class="display-3 fw-bold">Heaven's Kitchen</h1>
                    <p class="lead mt-3">Поръчай любимата си храна бързо, лесно и с вкус, който се помни.</p>
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <a href="#menu" class="btn btn-main btn-lg">Виж менюто</a>
                        <?php if (empty($_SESSION['user_id'])): ?>
                            <a href="register.php" class="btn btn-outline-light btn-lg">Създай акаунт</a>
                            <a href="login.php" class="btn btn-light btn-lg">Вход</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="menu" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title display-5">Нашето меню</h2>
            <p class="text-muted">Избери храна, добави количество и я поръчай.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($foods as $food): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card food-card">
                        <img src="<?= htmlspecialchars($food['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($food['name']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($food['name']) ?></h5>
                            <p class="card-text text-muted flex-grow-1"><?= htmlspecialchars($food['description']) ?></p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="price"><?= number_format($food['price'], 2) ?> лв.</span>
                            </div>
                            <form action="add_to_cart.php" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
                                <input type="number" name="quantity" value="1" min="1" class="form-control" style="max-width: 90px;">
                                <button type="submit" class="btn btn-main w-100">Добави</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
