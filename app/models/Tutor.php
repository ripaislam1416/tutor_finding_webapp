<?php

class Tutor {
    /**
     * @var \mysqli
     */
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Retrieve available tutors joining profile and subject data.
     *
     * @return \mysqli_result
     */
    public function getTutors() {
        $sql = "SELECT u.id, u.name,
                       tp.location,
                       tp.hourly_rate,
                       s.subject_name AS subject
                FROM users u
                JOIN tutor_profiles tp ON u.id = tp.user_id
                JOIN tutor_subjects ts ON u.id = ts.tutor_id
                JOIN subjects s ON ts.subject_id = s.id
                WHERE u.role = 'tutor'";

        return $this->conn->query($sql);
    }

    /**
     * Get tutor profile by user ID
     *
     * @param int $userId
     * @return array|null
     */
    public function getProfileByUserId($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM tutor_profiles WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $profile = $result->fetch_assoc();
        $stmt->close();
        return $profile;
    }

    /**
     * Check if tutor profile exists
     *
     * @param int $userId
     * @return bool
     */
    public function profileExists($userId) {
        $stmt = $this->conn->prepare("SELECT id FROM tutor_profiles WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    /**
     * Create new tutor profile
     *
     * @param int $userId
     * @param string $bio
     * @param string $qualification
     * @param int $experienceYears
     * @param float $hourlyRate
     * @param string $location
     * @param string $profileImage
     * @return bool
     */
    public function createProfile($userId, $bio, $qualification, $experienceYears, $hourlyRate, $location, $profileImage = null) {
        $stmt = $this->conn->prepare("INSERT INTO tutor_profiles (user_id, bio, qualification, experience_years, hourly_rate, location, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('issidss', $userId, $bio, $qualification, $experienceYears, $hourlyRate, $location, $profileImage);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Update tutor profile
     *
     * @param int $userId
     * @param string $bio
     * @param string $qualification
     * @param int $experienceYears
     * @param float $hourlyRate
     * @param string $location
     * @param string $profileImage
     * @return bool
     */
    public function updateProfile($userId, $bio, $qualification, $experienceYears, $hourlyRate, $location, $profileImage = null) {
        if ($profileImage) {
            $stmt = $this->conn->prepare("UPDATE tutor_profiles SET bio = ?, qualification = ?, experience_years = ?, hourly_rate = ?, location = ?, profile_image = ? WHERE user_id = ?");
            $stmt->bind_param('ssidssi', $bio, $qualification, $experienceYears, $hourlyRate, $location, $profileImage, $userId);
        } else {
            $stmt = $this->conn->prepare("UPDATE tutor_profiles SET bio = ?, qualification = ?, experience_years = ?, hourly_rate = ?, location = ? WHERE user_id = ?");
            $stmt->bind_param('ssidss', $bio, $qualification, $experienceYears, $hourlyRate, $location, $userId);
        }
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>