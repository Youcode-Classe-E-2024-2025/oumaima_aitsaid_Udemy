<?php
class User {
    protected $conn;
    protected $table_name = "utilisateurs";
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
//--------------------------magic Method Construct -------------------------------------------//
    public function __construct($db) {
        $this->conn = $db;
    }

    //----------------------------------- Getters---------------------------------------------//
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getRole() {
        return $this->role;
    }

    //-------------------------------- Setters---------------------------------------------------//
    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = htmlspecialchars(strip_tags($username));
    }

    public function setEmail($email) {
        $this->email = htmlspecialchars(strip_tags($email));
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setRole($role) {
        $this->role = htmlspecialchars(strip_tags($role));
    }
   //--------------------------------Methode Create -----------------------------------//
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET username=:username, email=:email, password=:password, role=:role";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

}