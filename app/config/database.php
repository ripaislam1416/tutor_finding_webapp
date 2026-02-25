<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'tutor_finder';
    private $username = 'root';
    private $password = '';
    private $conn;

    /**
     * Establish a database connection using MySQLi
     *
     * @return \mysqli
     */
    public function connect() {
        $this->conn = null;

        // adjust credentials above as needed for your environment
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die('Database connection error: ' . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
