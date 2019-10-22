<?php
class Post
{
    // Database connection
    private $conn;
    private $table_name = 'posts';

    // Post Properties
    public $id;
    public $title;
    public $content;
    public $author;
    public $category_id;
    public $created_at;
    public $updated_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        // Insert query.
        $query = "INSERT INTO " . $this->table_name . "
            SET 
                title = :title,
                content = :content,
                author = :author,
                category_id = :category_id,
                created_at = :created_at";

        $stmt = $this->conn->prepare($query);


        // Sanitize data.
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // timestamp for the created_at field.
        $this->timestamp = date('Y-m-d H:i:s');

        // Binding values.
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':author', $this->content);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':created_at', $this->timestamp);

        //executing query and also checking if it was successful.
        if ($stmt->execute()) {
            return true;
        }
        // If something goes wrong.
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
