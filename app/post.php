<?php
require_once 'config.php';
require_once 'db.php';

$db = new Database();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$post = $db->getPostById($_GET['id']);
if (!$post) {
    header('Location: index.php');
    exit;
}

$comments = $db->getCommentsByPostId($post['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_comment'])) {
    $authorName = trim($_POST['author_name'] ?? '');
    $authorEmail = trim($_POST['author_email'] ?? '');
    $content = trim($_POST['content'] ?? '');
    
    if ($authorName && $authorEmail && $content) {
        if (filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
            $db->createComment($post['id'], $authorName, $authorEmail, $content);
            header('Location: post.php?id=' . $post['id'] . '&success=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Blog de Seguridad Web</title>
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
            <a href="about.php">Acerca de</a>
        </div>
    </nav>

    <main class="container">
        <article class="post-detail">
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <div class="post-meta">
                <span class="author">👤 <?php echo htmlspecialchars($post['author']); ?></span>
                <span class="date">📅 <?php echo date('d/m/Y H:i', strtotime($post['created_at'])); ?></span>
            </div>
            <div class="post-content">
                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
            </div>
        </article>

        <section class="comments">
            <h3>💬 Comentarios (<?php echo count($comments); ?>)</h3>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert success">¡Comentario enviado! Está pendiente de aprobación.</div>
            <?php endif; ?>

            <?php if (empty($comments)): ?>
                <p class="no-comments">No hay comentarios aún. ¡Sé el primero en comentar!</p>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment">
                        <div class="comment-author">
                            <strong><?php echo htmlspecialchars($comment['author_name']); ?></strong>
                            <span class="comment-date"><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></span>
                        </div>
                        <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="comment-form">
                <h4>Agregar comentario</h4>
                <form method="POST">
                    <input type="text" name="author_name" placeholder="Tu nombre" required>
                    <input type="email" name="author_email" placeholder="Tu email" required>
                    <textarea name="content" placeholder="Tu comentario" rows="4" required></textarea>
                    <button type="submit" name="add_comment">Enviar comentario</button>
                </form>
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
