<?php

class Auth 
{
    public $id;
    public $username;
    public $password;
    public $role;
    public $fullname;
    public $sdt;

    //login 
    public static function login($pdo, $username, $password) {
        $sql = "SELECT password FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $passwd = $stmt->fetchColumn();
            if($password == $passwd) {
                $_SESSION['log_detail'] = $username;
                header('location: index.php');
                exit();
            }
        }
        return 'Tài khoản hoặc mật khẩu không chính xác!';
    }

    public static function getRole($pdo, $username) {
        $sql = "SELECT role FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $role = $stmt->fetchColumn();
            return $role;
        }
        return 'Lấy role thất bại!';
    }

    public static function getIdUser($pdo, $username) {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $id = $stmt->fetchColumn();
            return $id;
        }
        return 'Lấy id thất bại!';
    }

    public static function logout() {
        session_unset();
        session_destroy();
        header('location: index.php');
        exit;
    }

    public function checkExistUser($pdo, $username)
    {
        $sql = "SELECT COUNT(*) AS dem FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS);
            return $stmt->fetch();
        }
    }
    public function createUser($pdo) 
    {
        $sql = "INSERT INTO users(username, password, role, fullname, sdt) VALUES (:username, :password, 'user', :fullname, :sdt)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':fullname', $this->fullname, PDO::PARAM_STR);
        $stmt->bindValue(':sdt', $this->sdt, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
    
    //show all user
    public static function getAllUser($pdo) {
        $sql = "SELECT * FROM users";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Auth');
            return $stmt->fetchAll();
        }
    }
    //delete user
    public function deleteUser($pdo, $id) 
    {
        $sql = "DELETE FROM users WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
    //show 1 user
    public static function getOneUserByID($pdo, $id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Auth');
            return $stmt->fetch();
        }
    }
    //cap nhật user
    public function updateUser($pdo, $id)
    {
        $sql = "UPDATE users SET username = :username, password = :password, role = :role, fullname = :fullname, sdt = :sdt WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindValue(':role', $this->role, PDO::PARAM_STR);
        $stmt->bindValue(':fullname', $this->fullname, PDO::PARAM_STR);
        $stmt->bindValue(':sdt', $this->sdt, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
}