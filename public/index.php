<?php
session_start();

require_once '../config/database.php';
require_once '../app/helpers.php';
require_once '../app/models/UserModel.php';
require_once '../app/models/PostModel.php';
require_once '../app/models/CommentModel.php';
require_once '../app/models/LikeModel.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/PostController.php';
require_once '../app/controllers/CommentController.php';
require_once '../app/controllers/LikeController.php';
require_once '../app/controllers/ProfileController.php';
require_once '../app/controllers/SearchController.php';

$db = (new Database())->connect();
$page = $_GET['page'] ?? (isLoggedIn() ? 'home' : 'login');

switch ($page) {
    case 'login':
        (new AuthController($db))->login();
        break;
    case 'register':
        (new AuthController($db))->register();
        break;
    case 'logout':
        (new AuthController($db))->logout();
        break;
    case 'home':
        (new HomeController($db))->index();
        break;
    case 'post_create':
        (new PostController($db))->create();
        break;
    case 'post_edit':
        (new PostController($db))->edit();
        break;
    case 'post_delete':
        (new PostController($db))->delete();
        break;
    case 'comment_create':
        (new CommentController($db))->create();
        break;
    case 'comment_edit':
        (new CommentController($db))->edit();
        break;
    case 'comment_delete':
        (new CommentController($db))->delete();
        break;
    case 'like':
        (new LikeController($db))->toggle();
        break;
    case 'profile':
        (new ProfileController($db))->index();
        break;
    case 'profile_edit':
        (new ProfileController($db))->edit();
        break;
    case 'search':
        (new SearchController($db))->index();
        break;
    default:
        redirect(isLoggedIn() ? 'home' : 'login');
}
