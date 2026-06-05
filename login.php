<?php
require_once 'includes/db.php';
include 'includes/header.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Грешен имейл или парола.';
    }
}
?>
<div class="container page-wrap">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="auth-box">
                <h2 class="section-title mb-4">Вход</h2>
                <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
                <form method="POST">
                    <div class="mb-3"><label class="form-label">Имейл</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Парола</label><input type="password" name="password" class="form-control" required></div>
                    <button class="btn btn-main w-100">Влез</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
