-- Script de creación de la base de datos para Gestión de Hotel
-- Dialecto: MariaDB

DROP DATABASE IF EXISTS hotel_db;
CREATE DATABASE hotel_db;
USE hotel_db;

-- Creación de tablas sin claves primarias ni foráneas inicialmente

DROP TABLE IF EXISTS reservas;
DROP TABLE IF EXISTS habitaciones;
DROP TABLE IF EXISTS huespedes;

CREATE TABLE huespedes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    nombre VARCHAR(100) NOT NULL,
    dni VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    vip BOOLEAN DEFAULT FALSE
) ENGINE=InnoDB;

CREATE TABLE habitaciones (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    numero VARCHAR(10) NOT NULL,
    tipo VARCHAR(50) NOT NULL, -- 'SIMPLE', 'DOBLE', 'SUITE'
    precio_noche DECIMAL(10, 2) NOT NULL,
    planta INT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE reservas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    huesped_id INT NOT NULL,
    habitacion_id INT NOT NULL,
    fecha_entrada DATE NOT NULL,
    dias INT NOT NULL,
    costo_total DECIMAL(10, 2),
    estado VARCHAR(20) DEFAULT 'CONFIRMADA'
) ENGINE=InnoDB;

-- Definición de Restricciones Unique

ALTER TABLE huespedes
    ADD CONSTRAINT uk_huesped_dni UNIQUE (dni);

ALTER TABLE habitaciones
    ADD CONSTRAINT uk_habitacion_numero UNIQUE (numero);

-- Definición de Claves Ajenas

ALTER TABLE reservas
    ADD CONSTRAINT fk_reserva_huesped
    FOREIGN KEY (huesped_id) REFERENCES huespedes(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE reservas
    ADD CONSTRAINT fk_reserva_habitacion
    FOREIGN KEY (habitacion_id) REFERENCES habitaciones(id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

-- Definición de Restricciones Check

ALTER TABLE habitaciones
    ADD CONSTRAINT chk_precio_noche CHECK (precio_noche > 0);

-- Inserción de datos (Al menos 5 registros y relaciones)

INSERT INTO huespedes (nombre, dni, email, vip) VALUES
('Juan Pérez', '12345678A', 'juan.perez@mail.com', FALSE),
('Maria García', '87654321B', 'maria.garcia@mail.com', TRUE),
('Luis Torres', '11223344C', 'luis.torres@mail.com', FALSE),
('Ana Gomez', '44332211D', 'ana.gomez@mail.com', TRUE),
('Pedro Sola', '99887766E', 'pedro.sola@mail.com', FALSE);

INSERT INTO habitaciones (numero, tipo, precio_noche, planta) VALUES
('101', 'SIMPLE', 50.00, 1),
('102', 'DOBLE', 80.00, 1),
('201', 'SUITE', 150.00, 2),
('202', 'DOBLE', 85.00, 2),
('301', 'SUITE_PREMIUM', 250.00, 3);

INSERT INTO reservas (huesped_id, habitacion_id, fecha_entrada, dias, costo_total, estado) VALUES
(1, 1, '2025-06-01', 5, 200.00, 'CONFIRMADA'), -- 4 noches * 50
(2, 3, '2025-07-10', 10, 300.00, 'CONFIRMADA'), -- 2 noches * 150
(3, 2, '2025-08-01', 12, 720.00, 'CHECKED_OUT'),
(4, 5, '2025-09-01', 13, 250.00, 'CANCELADA'),
(1, 4, '2025-10-15', 18, 425.00, 'CONFIRMADA');
