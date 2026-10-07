<?php
class LikeController
{
    private $likes;

    public function __construct($db)
    {
        $this->likes = new LikeModel($db);
    }

    public function toggle()
    {
        requireLogin();
        $postId = (int)($_GET['post_id'] ?? 0);

        if ($postId > 0) {
            $this->likes->toggle($postId, currentUserId());
        }

        redirect('home');
    }
}
