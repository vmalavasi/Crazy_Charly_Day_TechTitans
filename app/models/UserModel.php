<?php

class UserModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id=:id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch();
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM users WHERE username=:username";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':username', $username);
        $statement->execute();
        return $statement->fetch();
    }
}
?>
