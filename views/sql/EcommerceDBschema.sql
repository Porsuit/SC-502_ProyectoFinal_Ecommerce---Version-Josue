-- Crear la base de datos
CREATE DATABASE ecommerce;

-- Usar la base de datos creada
USE ecommerce;

-- Crear un nuevo usuario para gestionar la base de datos
CREATE USER 'ecommerce_user'@'localhost' IDENTIFIED BY 'passwordDebilPrueba';

-- Conceder permisos al usuario solo para esta base de datos
GRANT ALL PRIVILEGES ON ecommerce.* TO 'ecommerce_user'@'localhost';

-- Aplicar cambios
FLUSH PRIVILEGES;

-- Confirmar que el usuario tiene acceso
SHOW GRANTS FOR 'ecommerce_user'@'localhost';

-- Creación de las diferentes tablas usuarios, clientes, categorias, productos, ordenes, detalle ordenes, transacciones, roles y permisos
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    role ENUM('admin', 'vendedor', 'cliente') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    telefono VARCHAR(20),
    direccion TEXT,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE, 
    descripcion TEXT
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    nombre_producto VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    inventario INT NOT NULL DEFAULT 0,
    imagen_url VARCHAR(255),
    creada_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

CREATE TABLE ordenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha_orden TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cantidad_total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'completada', 'cancelada') NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE 
);

CREATE TABLE ordenes_detalles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orden_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (orden_id) REFERENCES ordenes(id) ON DELETE CASCADE, 
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE 
);

CREATE TABLE transacciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    orden_id INT NOT NULL, -- Corregido "order_id" por "orden_id"
    fecha_transaccion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    metodo_pago ENUM('credit_card', 'paypal', 'bank_transfer') NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (orden_id) REFERENCES ordenes(id) ON DELETE CASCADE
);

CREATE TABLE roles_permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('admin', 'vendedor', 'cliente') NOT NULL, 
    permisos VARCHAR(50) NOT NULL
);
