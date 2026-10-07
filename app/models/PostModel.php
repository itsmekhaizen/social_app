<?php
class PostModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $sql = 'SELECT p.*, u.username, u.full_name, u.profile_image,
                (SELECT COUNT(*) FROM likes l WHERE l.post_id = p.id) AS like_count
                FROM posts p
                JOIN users u ON u.id = p.user_id
                ORDER BY p.created_at DESC';
        return $this->db->query($sql)->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($userId, $content, $image = null)
    {
        $stmt = $this->db->prepare('INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)');
        return $stmt->execute([$userId, $content, $image]);
    }

    public function update($id, $userId, $content, $image = null)
    {
        if ($image !== null) {
            $stmt = $this->db->prepare('UPDATE posts SET content = ?, image = ?, updated_at = NOW() WHERE id = ? AND user_id = ?');
            return $stmt->execute([$content, $image, $id, $userId]);
        }

        $stmt = $this->db->prepare('UPDATE posts SET content = ?, updated_at = NOW() WHERE id = ? AND user_id = ?');
        return $stmt->execute([$content, $id, $userId]);
    }

    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare('DELETE FROM posts WHERE id = ? AND user_id = ?');
        return $stmt->execute([$id, $userId]);
    }
}
