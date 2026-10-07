<?php

class UserModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createUser($username, $password, $fullName, $bio)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users
                (username, password, full_name, bio)
                VALUES
                (:username, :password, :full_name, :bio)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":username" => $username,
            ":password" => $hashedPassword,
            ":full_name" => $fullName,
            ":bio" => $bio
        ]);
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users
                WHERE username = :username";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":username" => $username
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        return $this->getUserById($id);
    }

    public function update($id, $fullName, $bio, $profileImage = null)
    {
        if ($profileImage !== null) {

            $sql = "UPDATE users
                    SET full_name = :full_name,
                        bio = :bio,
                        profile_image = :profile_image
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ":full_name" => $fullName,
                ":bio" => $bio,
                ":profile_image" => $profileImage,
                ":id" => $id
            ]);
        }

        $sql = "UPDATE users
                SET full_name = :full_name,
                    bio = :bio
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":full_name" => $fullName,
            ":bio" => $bio,
            ":id" => $id
        ]);
    }

    public function search($keyword)
    {
        $sql = "SELECT *
                FROM users
                WHERE username LIKE :keyword
                OR full_name LIKE :keyword
                ORDER BY full_name ASC";

        $stmt = $this->conn->prepare($sql);

        $search = "%" . $keyword . "%";

        $stmt->execute([
            ":keyword" => $search
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>