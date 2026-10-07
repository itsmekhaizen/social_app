<?php

require_once __DIR__ . "/../models/UserModel.php";

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            $fullName = trim($_POST["full_name"]);
            $bio = "";

            if (
                empty($username) ||
                empty($password) ||
                empty($fullName)
            ) {
                $error = "Please fill in all required fields.";
                require "../app/views/auth/register.php";
                return;
            }

            $existingUser =
                $this->userModel->getUserByUsername($username);

            if ($existingUser) {
                $error = "Username already exists.";
                require "../app/views/auth/register.php";
                return;
            }

            $this->userModel->createUser(
                $username,
                $password,
                $fullName,
                $bio
            );

            header("Location: index.php?page=login");
            exit;
        }

        require "../app/views/auth/register.php";
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            $user =
                $this->userModel->getUserByUsername($username);

            if (
                $user &&
                password_verify($password, $user["password"])
            ) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["full_name"] = $user["full_name"];

                header("Location: index.php?page=home");
                exit;
            }

            $error = "Invalid username or password.";

            require "../app/views/auth/login.php";
            return;
        }

        require "../app/views/auth/login.php";
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header("Location: index.php?page=login");
        exit;
    }
}
?>