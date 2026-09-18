<?php require_once __DIR__ . '/../layout.php'; layout_head('Permisos de Usuario'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Control de Permisos</h5>
        <a class="btn btn-outline-secondary btn-sm" href="<?= url('index.php?c=usuario&a=index') ?>">
            <i class="bi bi-person-badge me-1"></i>Usuarios
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($usuarios)): ?>
                <tr><td colspan="5" class="text-center text-secondary py-4">No hay usuarios registrados</td></tr>
            <?php else: foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <span class="badge text-bg-<?= $u['rol'] === 'admin' ? 'danger' : 'primary' ?>">
                            <?= htmlspecialchars($u['rol']) ?>
                        </span>
                    </td>
                    <td class="text-end">
                        <?php if ($u['rol'] === 'admin'): ?>
                            <span class="badge text-bg-success">Acceso total</span>
                        <?php else: ?>
                            <a class="btn btn-outline-primary btn-sm" href="<?= url('index.php?c=permiso&a=editar&id=' . $u['id']) ?>">
                                <i class="bi bi-key me-1"></i>Asignar permisos
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php layout_foot(); ?>
