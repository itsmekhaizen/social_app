<?php
class CommentModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getByPost($postId)
    {
        $sql = 'SELECT c.*, u.username, u.full_name FROM comments c JOIN users u ON u.id = c.user_id WHERE c.post_id = ? ORDER BY c.created_at ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    public function create($postId, $userId, $content)
    {
        $stmt = $this->db->prepare('INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)');
        return $stmt->execute([$postId, $userId, $content]);
    }

    public function update($id, $userId, $content)
    {
        $stmt = $this->db->prepare('UPDATE comments SET content = ? WHERE id = ? AND user_id = ?');
        return $stmt->execute([$content, $id, $userId]);
    }

    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare('DELETE FROM comments WHERE id = ? AND user_id = ?');
        return $stmt->execute([$id, $userId]);
    }
}
