<?php

class User
{
    // Database connection
    private $conn;
    private $table_name = 'users';

    // User Properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // New user record
    public function create()
    {
        //Insert query
        $query = "INSERT INTO " . $this->table_name . "
            SET 
            name = :name,
            email = :email,
            password = :password,
            created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        // sanitize data.
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // timestamp for the created_at field.
        $this->timestamp = date('Y-m-d H:i:s');

        // Binding values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':created_at', $this->timestamp);


        // password hashing
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        //executing query and also checking if it was successful.
        if ($stmt->execute()) {
            return true;
        }
        // If something goes wrong.
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    /* Loging in a user.
    *
    * Check if email exist.
    */
    public function emailExists()
    {
        // Query if email exist in database.
        $query = "SELECT id, name, password
            FROM " . $this->table_name . " 
            WHERE email = ?
            LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        // Sanitize data.
        $this->email = htmlspecialchars(strip_tags($this->email));

        // bind email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // If email exist, assign values.
        if ($num > 0) {
            // Fetch record details.
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Assign values to object properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            // Return true because email exist.
            return true;
        }
        // Return false if it does not exist,
        return false;
    }
}
