<?php

class Users {
    /**
     * @var \mysqli
     */
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function exists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function register($name, $email, $password, $phone, $role) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, phone, role) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $name, $email, $password, $phone, $role);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
