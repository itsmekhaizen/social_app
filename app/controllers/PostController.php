<?php
class PostController
{
    private $posts;

    public function __construct($db)
    {
        $this->posts = new PostModel($db);
    }

    public function create()
    {
        requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $image = $this->uploadImage($_FILES['image'] ?? null, 'post');

            if ($content === '') {
                $error = 'Post content is required.';
            } else {
                $this->posts->create(currentUserId(), $content, $image);
                redirect('home');
            }
        }

        require '../app/views/post/form.php';
    }

    public function edit()
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $post = $this->posts->findById($id);

        if (!$post || $post['user_id'] != currentUserId()) {
            redirect('home');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');

            if ($content === '') {
                $error = 'Post content is required.';
            } else {
                $image = $this->uploadImage($_FILES['image'] ?? null, 'post');
                $this->posts->update($id, currentUserId(), $content, $image);
                redirect('home');
            }
        }

        require '../app/views/post/form.php';
    }

    public function delete()
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $this->posts->delete($id, currentUserId());
        redirect('home');
    }

    private function uploadImage($file, $type)
    {
        if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if ($file['error'] !== UPLOAD_ERR_OK || !in_array($file['type'], $allowed, true) || $file['size'] > 2 * 1024 * 1024) {
            return null;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $name = $type . '_' . uniqid() . '.' . $extension;
        $path = '../public/uploads/' . $name;

        if (move_uploaded_file($file['tmp_name'], $path)) {
            return $name;
        }

        return null;
    }
}
