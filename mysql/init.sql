CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at),
    INDEX idx_author (author)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO posts (title, content, author) VALUES
('Bienvenido al Blog de Seguridad Web', 'Este es el primer post del blog. Aquí aprenderás sobre las mejores prácticas de seguridad en aplicaciones web y Docker.', 'Admin'),
('Docker y Seguridad: Mejores Prácticas', 'Docker es una herramienta poderosa, pero debe usarse correctamente. Nunca expongas puertos innecesarios, usa variables de entorno para credenciales, y mantén tus imágenes actualizadas.', 'Admin'),
('Bases de Datos Seguras en Producción', 'Proteger tus bases de datos es crucial. Usa contraseñas fuertes, limita el acceso por IP, habilita SSL/TLS, y realiza backups regulares.', 'Admin'),
('Autenticación y Autorización', 'Implementa autenticación robusta usando tokens JWT, OAuth2, o sesiones seguras. Nunca almacenes contraseñas en texto plano.', 'Security Team'),
('Prevención de Inyección SQL', 'Usa prepared statements y ORM para prevenir ataques de inyección SQL. Valida y sanitiza todas las entradas del usuario.', 'Security Team');

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editor', 'viewer') DEFAULT 'viewer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (username, email, password_hash, role) VALUES
('admin', 'admin@blog.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('editor', 'editor@blog.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'editor'),
('viewer', 'viewer@blog.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'viewer');

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    author_name VARCHAR(100) NOT NULL,
    author_email VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    approved BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    INDEX idx_post_id (post_id),
    INDEX idx_approved (approved)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO comments (post_id, author_name, author_email, content, approved) VALUES
(1, 'Juan Pérez', 'juan@example.com', '¡Excelente blog! Muy útil la información.', TRUE),
(2, 'María García', 'maria@example.com', 'Gracias por compartir estas prácticas de seguridad.', TRUE),
(3, 'Carlos López', 'carlos@example.com', '¿Podrían profundizar más en el tema de backups?', TRUE);
