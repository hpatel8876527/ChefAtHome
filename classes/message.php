<?php


class Message
{
    private $db;

    public function __construct(PDO $conn)
    {
        $this->db = $conn;
    }

    public function create_message($data)
    {

        $full_name = $data["full_name"];
        $email = $data["email"];
        $message = $data["message"];
        
        $stmt = $this->db->prepare("INSERT INTO messages (full_name, email, message) VALUES (:full_name, :email, :message)");
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

    }



    public function get_all_message_data()
    {


        $stmt = $this->db->prepare("SELECT * FROM messages ORDER BY id DESC");
        $stmt->execute();
        $messages = $stmt->fetchAll();

        return $messages;

    }


}
