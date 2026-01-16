<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de - Blog de Seguridad Web</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>🔒 Blog de Seguridad Web</h1>
            <p>Aprende sobre Docker, MySQL y mejores prácticas de seguridad</p>
        </div>
    </header>

    <nav>
        <div class="container">
            <a href="index.php">Inicio</a>
            <a href="posts.php">Posts</a>
            <a href="about.php" class="active">Acerca de</a>
        </div>
    </nav>

    <main class="container">
        <section class="about">
            <h2>📖 Acerca de este proyecto</h2>
            
            <div class="about-content">
                <h3>🎯 Objetivo</h3>
                <p>Este es un proyecto final de Docker que demuestra cómo construir una aplicación web completa con:</p>
                <ul>
                    <li>✅ PHP 8.2 con Apache</li>
                    <li>✅ MySQL 8.0 como base de datos</li>
                    <li>✅ Docker Compose para orquestación</li>
                    <li>✅ phpMyAdmin para administración</li>
                    <li>✅ Imagen personalizada publicable en Docker Hub</li>
                </ul>

                <h3>🏗️ Arquitectura</h3>
                <p>La aplicación está compuesta por 3 contenedores Docker:</p>
                <ul>
                    <li><strong>blog_app</strong>: Aplicación PHP personalizada</li>
                    <li><strong>blog_mysql</strong>: Base de datos MySQL</li>
                    <li><strong>blog_phpmyadmin</strong>: Interfaz de administración</li>
                </ul>

                <h3>🔒 Seguridad</h3>
                <p>Implementa las siguientes medidas de seguridad:</p>
                <ul>
                    <li>Variables de entorno para credenciales</li>
                    <li>Prepared statements para prevenir SQL injection</li>
                    <li>Validación y sanitización de inputs</li>
                    <li>Red aislada entre contenedores</li>
                    <li>Health checks para monitoreo</li>
                </ul>

                <h3>🚀 Tecnologías</h3>
                <div class="tech-stack">
                    <span class="tech-badge">Docker</span>
                    <span class="tech-badge">PHP 8.2</span>
                    <span class="tech-badge">MySQL 8.0</span>
                    <span class="tech-badge">Apache</span>
                    <span class="tech-badge">PDO</span>
                    <span class="tech-badge">CSS3</span>
                </div>

                <h3>📦 Docker Hub</h3>
                <p>Esta aplicación puede ser publicada en Docker Hub como una imagen personalizada, permitiendo que otros desarrolladores la descarguen y usen fácilmente.</p>

                <h3>👨‍💻 Autor</h3>
                <p>Proyecto Final - Curso de Docker</p>
                <p>Año: 2026</p>
            </div>
        </section>

        <a href="index.php" class="back-link">← Volver al inicio</a>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2026 Blog de Seguridad Web | Proyecto Docker Final</p>
        </div>
    </footer>
</body>
</html>
