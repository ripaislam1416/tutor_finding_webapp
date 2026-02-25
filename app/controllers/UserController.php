<?php

class UserController {
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        require_once __DIR__ . '/../models/users.php';
        $this->model = new Users($db);
    }

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->model->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                // Redirect based on user role
                if ($user['role'] === 'tutor') {
                    header('Location: index.php?page=tutor_dashboard');
                } else {
                    header('Location: index.php?page=student_dashboard');
                }
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        }
        include __DIR__ . '/../views/login.php';
    }

    public function register() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
            $phone = $_POST['phone'] ?? '';
            $role = $_POST['role'] ?? 'student';

            if ($this->model->exists($email)) {
                $error = 'Email already registered';
            } else {
                $this->model->register($name, $email, $password, $phone, $role);
                header('Location: index.php?page=login');
                exit;
            }
        }
        include __DIR__ . '/../views/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
