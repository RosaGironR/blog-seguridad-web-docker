<?php
class Database {
    private $conn;
    
    public function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
    
    public function getAllPosts() {
        $stmt = $this->conn->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    public function getPostById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function getCommentsByPostId($postId) {
        $stmt = $this->conn->prepare("SELECT * FROM comments WHERE post_id = ? AND approved = 1 ORDER BY created_at DESC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }
    
    public function createPost($title, $content, $author) {
        $stmt = $this->conn->prepare("INSERT INTO posts (title, content, author) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $content, $author]);
    }
    
    public function createComment($postId, $authorName, $authorEmail, $content) {
        $stmt = $this->conn->prepare("INSERT INTO comments (post_id, author_name, author_email, content) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$postId, $authorName, $authorEmail, $content]);
    }
}
