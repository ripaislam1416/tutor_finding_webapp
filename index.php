<?php
session_start();

require_once __DIR__ . '/app/config/database.php';
require_once __DIR__ . '/app/controllers/TutorController.php';
require_once __DIR__ . '/app/controllers/UserController.php';

$database = new Database();
$db = $database->connect();

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'login':
        $controller = new UserController($db);
        $controller->login();
        break;
    case 'register':
        $controller = new UserController($db);
        $controller->register();
        break;
    case 'logout':
        $controller = new UserController($db);
        $controller->logout();
        break;
    case 'tutor_dashboard':
        // Tutor dashboard - require login and tutor role
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'tutor') {
            header('Location: index.php?page=login');
            exit;
        }
        include __DIR__ . '/app/views/tutor_dashboard.php';
        break;
    case 'tutor_profile':
        // Tutor profile page - handled by TutorController
        $controller = new TutorController($db);
        $controller->profile();
        break;
    case 'student_dashboard':
        // Student dashboard - require login
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $controller = new TutorController($db);
        $tutors = $controller->getTutors();
        include __DIR__ . '/app/views/student_dashboard.php';
        break;
    case 'tutors':
        $controller = new TutorController($db);
        $tutors = $controller->getTutors();
        include __DIR__ . '/app/views/tutors.php';
        break;
    case 'home':
    default:
        $controller = new TutorController($db);
        $controller->index();
        break;
}
?>