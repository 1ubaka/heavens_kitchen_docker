<?php
require_once 'includes/db.php';
include 'includes/header.php';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Моля, попълни всички полета.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, $hash]);
            $success = 'Регистрацията е успешна. Вече можеш да влезеш в профила си.';
        } catch (PDOException $e) {
            $error = 'Този имейл вече е регистриран.';
        }
    }
}
?>
<div class="container page-wrap">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="auth-box">
                <h2 class="section-title mb-4">Регистрация</h2>
                <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
                <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>
                <form method="POST">
                    <div class="mb-3"><label class="form-label">Име</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Имейл</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Парола</label><input type="password" name="password" class="form-control" required></div>
                    <button class="btn btn-main w-100">Регистрирай се</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
