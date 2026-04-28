-- Aseguramos que usamos la base de datos correcta
USE deportivo_db;

-- 1. Tabla de Usuarios (Cumple con los 3 tipos de usuario)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Guardaremos el hash de la clave
    email VARCHAR(100) NOT NULL,
    tipo ENUM('no_identificado', 'normal', 'especial') DEFAULT 'normal',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabla de Actividades/Instalaciones
CREATE TABLE IF NOT EXISTS actividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    capacidad_max INT NOT NULL, -- Para control de plazas
    tipo ENUM('clase', 'pista') NOT NULL
);

-- 3. Tabla de Sesiones (Horarios específicos)
CREATE TABLE IF NOT EXISTS sesiones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_actividad INT,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    FOREIGN KEY (id_actividad) REFERENCES actividades(id) ON DELETE CASCADE
);

-- 4. Tabla de Reservas (Relaciona usuario con sesión)
CREATE TABLE IF NOT EXISTS reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_sesion INT,
    fecha_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_sesion) REFERENCES sesiones(id) ON DELETE CASCADE,
    UNIQUE(id_usuario, id_sesion) -- Un usuario no puede reservar dos veces lo mismo
);

-- 5. Datos de prueba iniciales (Opcional, para que no esté vacía)
INSERT INTO actividades (nombre, descripcion, capacidad_max, tipo) VALUES 
('Pista de Pádel 1', 'Pista de cristal exterior', 4, 'pista'),
('Yoga', 'Clase dirigida de Hatha Yoga', 20, 'clase');

-- Usuario admin de prueba (Clave: admin123 - Hasheada sería algo así)
INSERT INTO usuarios (username, password, email, tipo) VALUES 
('admin', '$2y$10$8S8GfG66mX.pL.n9m7l8He2A.XJzQ3p6S7D8F9G0H1J2K3L4M5N6O', 'admin@deportivo.com', 'especial');
