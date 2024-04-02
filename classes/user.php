<?php


class User
{
    private $db;

    public function __construct(PDO $conn)
    {
        $this->db = $conn;
    }

    public function create_user($data)
    {

        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $phone_number = $data["phone_number"];
        $address = $data["address"];

        // Hash Password

        $password = password_hash($data["password"], PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, password, phone_number, address) VALUES (:first_name, :last_name, :email, :password, :phone_number, :address)");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);

        $stmt->execute();


        // Get the ID of the last inserted record
        $lastInsertedId = $this->db->lastInsertId();

        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $lastInsertedId);
        $stmt->execute();

        $user = $stmt->fetch();

        // Registered User
        return $user;

    }



    public function find_user($data)
    {

        $email = $data["email"];
        $password = $data["password"];

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch();

        // User exists
        if (!$user) {
            return false;
        }

        // Password matches

        if (password_verify($password, $user['password'])) {
            return $user;
        }

        return false;

    }


    public function get_user_data($user_id)
    {


        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id);

        $stmt->execute();
        $user = $stmt->fetch();

        return $user;

    }

    public function get_all_user_data()
    {


        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY ID DESC;");

        $stmt->execute();
        $user = $stmt->fetchAll();

        return $user;

    }

    public function update_user_profile($data)
    {
        $id = $data["id"];
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $phone_number = $data["phone_number"];
        $address = $data["address"];

        $stmt = $this->db->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, phone_number = :phone_number, address = :address WHERE id = :id");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        // Get the updated user data
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $user = $stmt->fetch();

        // Updated User
        return $user;
    }


    public function delete_user_data($user_id)
    {

        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        
    }


}
