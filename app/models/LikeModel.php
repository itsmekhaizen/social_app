<?php
class LikeModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function toggle($postId, $userId)
    {
        $stmt = $this->db->prepare('SELECT id FROM likes WHERE post_id = ? AND user_id = ?');
        $stmt->execute([$postId, $userId]);
        $like = $stmt->fetch();

        if ($like) {
            $stmt = $this->db->prepare('DELETE FROM likes WHERE id = ?');
            return $stmt->execute([$like['id']]);
        }

        $stmt = $this->db->prepare('INSERT INTO likes (post_id, user_id) VALUES (?, ?)');
        return $stmt->execute([$postId, $userId]);
    }
}
