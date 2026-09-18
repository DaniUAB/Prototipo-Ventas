<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= asset('styles/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('styles/css/bootstrap-icons.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('styles/css/app.css') ?>">
</head>
<body>
    <div class="login-page">
        <form class="card login-card" method="POST" action="<?= url('index.php?c=auth&a=autenticar') ?>">
            <div class="card-body p-4">
                <h1 class="h4 text-center mb-1">
                    <i class="bi bi-shop me-1"></i><?= APP_NAME ?>
                </h1>
                <p class="text-center text-secondary small mb-4">Ingrese sus credenciales</p>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <div><?= htmlspecialchars($error) ?></div>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <button class="btn btn-brand w-100" type="submit">
                    <i class="bi bi-box-arrow-in-right me-1"></i>Ingresar
                </button>

                <p class="text-center text-secondary mb-0 mt-4" style="font-size: .78rem; line-height: 1.6;">
                    admin@ventas.com / admin123<br>
                    vendedor@ventas.com / vendedor123
                </p>
            </div>
        </form>
    </div>
</body>
</html>
