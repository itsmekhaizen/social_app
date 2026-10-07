<?php
class CommentController
{
    private $comments;

    public function __construct($db)
    {
        $this->comments = new CommentModel($db);
    }

    public function create()
    {
        requireLogin();
        $postId = (int)($_POST['post_id'] ?? 0);
        $content = trim($_POST['content'] ?? '');

        if ($postId > 0 && $content !== '') {
            $this->comments->create($postId, currentUserId(), $content);
        }

        redirect('home');
    }

    public function edit()
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $content = trim($_POST['content'] ?? '');

        if ($id > 0 && $content !== '') {
            $this->comments->update($id, currentUserId(), $content);
        }

        redirect('home');
    }

    public function delete()
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $this->comments->delete($id, currentUserId());
        redirect('home');
    }
}
