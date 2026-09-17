SET NAMES utf8mb4;

USE ventas_db;

-- Usuarios iniciales
-- admin@ventas.com    / admin123    (rol admin: acceso total)
-- vendedor@ventas.com / vendedor123 (rol vendedor: permisos limitados)
INSERT IGNORE INTO usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@ventas.com', '$2y$10$MI2n49awdlI3k5siGR4MZOWmDaXQv9FtunUOhZTg4AUhsM0Ssq4cG', 'admin'),
('Vendedor Demo', 'vendedor@ventas.com', '$2y$10$d6qTLPP.QQqALRsT8BwJiOh7MzaFrbMmPTX7vMTO.F/Z.tPP94Lie', 'vendedor');

-- Catálogo de permisos
INSERT IGNORE INTO permisos (clave, modulo, descripcion) VALUES
('usuarios.ver',      'usuarios',   'Ver el módulo de usuarios'),
('usuarios.gestionar','usuarios',   'Crear, editar y eliminar usuarios'),
('clientes.ver',      'clientes',   'Ver el módulo de clientes'),
('clientes.gestionar','clientes',   'Crear, editar y eliminar clientes'),
('categorias.ver',      'categorias', 'Ver el módulo de categorías'),
('categorias.gestionar','categorias', 'Crear, editar y eliminar categorías'),
('productos.ver',      'productos',  'Ver el módulo de productos'),
('productos.gestionar','productos',  'Crear, editar y eliminar productos'),
('ventas.ver',      'ventas',     'Ver el módulo de ventas'),
('ventas.gestionar','ventas',     'Registrar y anular ventas');

-- Permisos asignados al vendedor de ejemplo
INSERT IGNORE INTO usuario_permisos (usuario_id, permiso_id)
SELECT u.id, p.id
FROM usuarios u
JOIN permisos p
WHERE u.email = 'vendedor@ventas.com'
  AND p.clave IN ('ventas.ver', 'ventas.gestionar', 'clientes.ver', 'productos.ver', 'categorias.ver');

-- Datos de ejemplo
INSERT IGNORE INTO categorias (id, nombre, descripcion) VALUES
(1, 'Bebidas',   'Gaseosas, jugos y agua'),
(2, 'Abarrotes', 'Productos de consumo básico');

INSERT IGNORE INTO productos (id, categoria_id, nombre, precio, stock) VALUES
(1, 1, 'Coca-Cola 2L', 12.50, 50),
(2, 2, 'Arroz 1kg',     8.00, 100);

INSERT IGNORE INTO clientes (id, nombre, documento, telefono, email, direccion) VALUES
(1, 'Juan Pérez', '1234567', '70000000', 'juan@example.com', 'Av. Principal 123');