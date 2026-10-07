<?php
class SearchController
{
    private $users;

    public function __construct($db)
    {
        $this->users = new UserModel($db);
    }

    public function index()
    {
        requireLogin();
        $keyword = trim($_GET['keyword'] ?? '');
        $users = $keyword !== '' ? $this->users->search($keyword) : [];
        require '../app/views/search/index.php';
    }
}
