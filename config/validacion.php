<?php
/**
 * Validación de formularios del lado del servidor.
 *
 * El `required` de HTML es solo una capa cosmética: cualquiera puede quitarlo
 * con las DevTools. Estas funciones son la protección real antes de tocar la
 * base de datos.
 *
 * Uso típico en un controlador:
 *
 *   $errores = validar_requeridos($_POST, ['nombre' => 'Nombre']);
 *   if ($errores) {
 *       $item = $_POST;                  // conserva lo que escribió el usuario
 *       $error = error_formulario($errores);
 *       require __DIR__ . '/../views/clientes/form.php';
 *       return;
 *   }
 */

/**
 * Comprueba que los campos dados no lleguen vacíos.
 *
 * $requeridos es un mapa: 'nombre_del_campo' => 'Etiqueta legible'
 * Soporta campos tipo array (p. ej. cantidad[] en ventas): se exige al menos
 * un elemento con valor.
 *
 * Devuelve un array de mensajes de error (vacío si todo está correcto).
 */
function validar_requeridos(array $datos, array $requeridos): array {
    $errores = [];

    foreach ($requeridos as $campo => $etiqueta) {
        $valor = $datos[$campo] ?? null;

        if (is_array($valor)) {
            $conValor = array_filter($valor, fn($v) => trim((string)$v) !== '');
            if (count($conValor) === 0) {
                $errores[] = "El campo \"$etiqueta\" es obligatorio.";
            }
            continue;
        }

        if (trim((string)$valor) === '') {
            $errores[] = "El campo \"$etiqueta\" es obligatorio.";
        }
    }

    return $errores;
}

/**
 * Convierte una lista de errores en texto HTML listo para $error.
 */
function error_formulario(array $errores): string {
    return implode('<br>', $errores);
}
