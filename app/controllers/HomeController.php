<?php
class HomeController
{
    private $posts;
    private $comments;

    public function __construct($db)
    {
        $this->posts = new PostModel($db);
        $this->comments = new CommentModel($db);
    }

    public function index()
    {
        requireLogin();
        $posts = $this->posts->getAll();
        $commentData = [];

        foreach ($posts as $post) {
            $commentData[$post['id']] = $this->comments->getByPost($post['id']);
        }

        require '../app/views/home/index.php';
    }
}
