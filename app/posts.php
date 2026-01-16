<?php
require_once 'config.php';
require_once 'db.php';

$db = new Database();
$posts = $db->getAllPosts();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Posts - Blog de Seguridad Web</title>
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
            <a href="posts.php" class="active">Posts</a>
            <a href="about.php">Acerca de</a>
        </div>
    </nav>

    <main class="container">
        <h2>📚 Todos los Posts</h2>
        
        <section class="posts-grid">
            <?php if (empty($posts)): ?>
                <p class="no-posts">No hay posts disponibles.</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <article class="post-card">
                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <div class="post-meta">
                            <span class="author">👤 <?php echo htmlspecialchars($post['author']); ?></span>
                            <span class="date">📅 <?php echo date('d/m/Y', strtotime($post['created_at'])); ?></span>
                        </div>
                        <p><?php echo nl2br(htmlspecialchars(substr($post['content'], 0, 150))); ?>...</p>
                        <a href="post.php?id=<?php echo $post['id']; ?>" class="read-more">Leer más →</a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2026 Blog de Seguridad Web | Proyecto Docker Final</p>
        </div>
    </footer>
</body>
</html>
