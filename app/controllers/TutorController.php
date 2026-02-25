<?php

class TutorController {
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        require_once __DIR__ . '/../models/Tutor.php';
        $this->model = new Tutor($db);
    }

    public function index() {
        $tutors = $this->model->getTutors();
        // render home view, which in turn displays the tutors
        include __DIR__ . '/../views/home.php';
    }

    /**
     * Get all tutors for use in other views
     *
     * @return \mysqli_result
     */
    public function getTutors() {
        return $this->model->getTutors();
    }

    /**
     * Handle tutor profile page (view and edit)
     */
    public function profile() {
        // Ensure user is logged in and is a tutor
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'tutor') {
            header('Location: index.php?page=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $profile = $this->model->getProfileByUserId($userId);
        
        $success = '';
        $error = '';

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bio = $_POST['bio'] ?? '';
            $qualification = $_POST['qualification'] ?? '';
            $experienceYears = intval($_POST['experience_years'] ?? 0);
            $hourlyRate = floatval($_POST['hourly_rate'] ?? 0);
            $location = $_POST['location'] ?? '';
            
            // Handle file upload
            $profileImage = null;
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../uploads/profiles/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $fileName = uniqid() . '_' . basename($_FILES['profile_image']['name']);
                $uploadFile = $uploadDir . $fileName;
                
                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = mime_content_type($_FILES['profile_image']['tmp_name']);
                
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
                        $profileImage = 'uploads/profiles/' . $fileName;
                    } else {
                        $error = 'Failed to upload image.';
                    }
                } else {
                    $error = 'Invalid file type. Only JPG, PNG, and GIF are allowed.';
                }
            }

            // Create or update profile
            if (empty($error)) {
                if ($profile) {
                    // Update existing profile
                    if ($this->model->updateProfile($userId, $bio, $qualification, $experienceYears, $hourlyRate, $location, $profileImage)) {
                        $success = 'Profile updated successfully!';
                        $profile = $this->model->getProfileByUserId($userId);
                    } else {
                        $error = 'Failed to update profile. Please try again.';
                    }
                } else {
                    // Create new profile
                    if ($this->model->createProfile($userId, $bio, $qualification, $experienceYears, $hourlyRate, $location, $profileImage)) {
                        $success = 'Profile created successfully!';
                        $profile = $this->model->getProfileByUserId($userId);
                    } else {
                        $error = 'Failed to create profile. Please try again.';
                    }
                }
            }
        }

        include __DIR__ . '/../views/tutor_profile.php';
    }
}
?>