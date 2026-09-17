<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | <?= APP_NAME ?></title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #1f2937 0%, #2563eb 100%);
        }
        .login-card {
            background: #fff; width: 100%; max-width: 380px; padding: 32px;
            border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,.25);
        }
        .login-card h1 { margin: 0 0 4px; font-size: 22px; color: #111827; text-align: center; }
        .login-card p.sub { margin: 0 0 24px; text-align: center; color: #6b7280; font-size: 13px; }
        .field { margin-bottom: 16px; }
        label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 600; color: #374151; }
        input { width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; }
        input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,.12); }
        .btn {
            width: 100%; padding: 11px; border: none; border-radius: 6px; background: #2563eb;
            color: #fff; font-size: 15px; font-weight: 600; cursor: pointer; transition: .2s;
        }
        .btn:hover { background: #1d4ed8; }
        .alert { background: #fee2e2; color: #991b1b; padding: 10px 14px; border-radius: 6px; margin-bottom: 16px; font-size: 14px; }
        .hint { margin-top: 18px; font-size: 12px; color: #9ca3af; text-align: center; line-height: 1.6; }
    </style>
</head>
<body>
    <form class="login-card" method="POST" action="<?= url('index.php?c=auth&a=autenticar') ?>">
        <h1><?= APP_NAME ?></h1>
        <p class="sub">Ingrese sus credenciales</p>

        <?php if (!empty($error)): ?>
            <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="field">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required autofocus>
        </div>
        <div class="field">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button class="btn" type="submit">Ingresar</button>

        <p class="hint">admin@ventas.com / admin123<br>vendedor@ventas.com / vendedor123</p>
    </form>
</body>
</html>