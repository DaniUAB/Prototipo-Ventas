<?php
/**
 * Componente reutilizable de modales Bootstrap.
 *
 * Uso:
 *   <?php modal_trigger('modalCrear', 'Nuevo Usuario'); ?>
 *
 *   <?php modal_open('modalCrear', 'Nuevo Usuario', url('index.php?c=usuario&a=crear')); ?>
 *       <!-- campos del formulario -->
 *   <?php modal_close('Guardar'); ?>
 */

function modal_trigger($id, $texto, $clase = 'btn btn-brand btn-sm', $icono = 'bi-plus-lg') {
    ?>
    <button type="button" class="<?= htmlspecialchars($clase) ?>" data-bs-toggle="modal" data-bs-target="#<?= htmlspecialchars($id) ?>">
        <i class="bi <?= htmlspecialchars($icono) ?> me-1"></i><?= htmlspecialchars($texto) ?>
    </button>
    <?php
}

function modal_open($id, $titulo, $accion = null, $tamano = '', $icono = 'bi-pencil-square') {
    $GLOBALS['__modal_con_form'] = ($accion !== null);
    $claseTamano = $tamano !== '' ? ' modal-' . $tamano : '';
    $etiqueta = $id . 'Label';
    ?>
    <div class="modal fade" id="<?= htmlspecialchars($id) ?>" tabindex="-1" aria-labelledby="<?= htmlspecialchars($etiqueta) ?>" aria-hidden="true">
        <div class="modal-dialog<?= $claseTamano ?> modal-dialog-centered">
            <div class="modal-content">
                <?php if ($accion !== null): ?><form method="POST" action="<?= htmlspecialchars($accion) ?>"><?php endif; ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?= htmlspecialchars($etiqueta) ?>">
                            <i class="bi <?= htmlspecialchars($icono) ?> me-2"></i><?= htmlspecialchars($titulo) ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
    <?php
}

function modal_close($boton = 'Guardar') {
    $conForm = !empty($GLOBALS['__modal_con_form']);
    ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <?= $conForm ? 'Cancelar' : 'Cerrar' ?>
                        </button>
                        <?php if ($conForm): ?>
                            <button type="submit" class="btn btn-brand">
                                <i class="bi bi-save me-1"></i><?= htmlspecialchars($boton) ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php if ($conForm): ?></form><?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}
