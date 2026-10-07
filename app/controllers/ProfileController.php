<?php
class ProfileController
{
    private $users;
    private $posts;

    public function __construct($db)
    {
        $this->users = new UserModel($db);
        $this->posts = new PostModel($db);
    }

    public function index()
    {
        requireLogin();
        $id = (int)($_GET['id'] ?? currentUserId());
        $user = $this->users->findById($id);
        $posts = [];

        if ($user) {
            foreach ($this->posts->getAll() as $post) {
                if ($post['user_id'] == $id) {
                    $posts[] = $post;
                }
            }
        }

        require '../app/views/profile/index.php';
    }

    public function edit()
    {
        requireLogin();
        $user = $this->users->findById(currentUserId());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = trim($_POST['full_name'] ?? '');
            $bio = trim($_POST['bio'] ?? '');
            $profileImage = $this->uploadProfileImage($_FILES['profile_image'] ?? null);

            if ($fullName === '') {
                $error = 'Full name is required.';
            } else {
                $this->users->update(currentUserId(), $fullName, $bio, $profileImage);
                redirect('profile');
            }
        }

        require '../app/views/profile/edit.php';
    }

    private function uploadProfileImage($file)
    {
        if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if ($file['error'] !== UPLOAD_ERR_OK || !in_array($file['type'], $allowed, true) || $file['size'] > 2 * 1024 * 1024) {
            return null;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $name = 'profile_' . uniqid() . '.' . $extension;
        $path = '../public/uploads/' . $name;

        return move_uploaded_file($file['tmp_name'], $path) ? $name : null;
    }
}
