<?php


class Chef
{
    private $db;

    public function __construct(PDO $conn)
    {
        $this->db = $conn;
    }

    public function create_chef($data, $file_data)
    {

        $img_url = $this->upload_image($file_data["img_url"]);
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $phone_number = $data["phone_number"];
        $specialization = $data["specialization"];
        $price_range = $data["price_range"];
        $experience_level = $data["experience_level"];
        $availability = $data["availability"];

        $rating = "⭐⭐⭐⭐ (4/5)";

        // Hash Password
        $password = password_hash($data["password"], PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("
    INSERT INTO chefs 
    (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability) 
    VALUES 
    (:img_url, :first_name, :last_name, :email, :password, :phone_number, :specialization, :price_range, :experience_level,  :rating, :availability)");
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':specialization', $specialization);
        $stmt->bindParam(':price_range', $price_range);
        $stmt->bindParam(':experience_level', $experience_level);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':availability', $availability);

        $stmt->execute();

        // Get the ID of the last inserted record
        $lastInsertedId = $this->db->lastInsertId();

        $stmt = $this->db->prepare("SELECT * FROM chefs WHERE id = :id");
        $stmt->bindParam(':id', $lastInsertedId);
        $stmt->execute();

        $chef = $stmt->fetch();

        // Registered Chef
        return $chef;
    }




    public function upload_image($file)
    {


        $target_dir = "./images/";

        $filename = rand(0, 9999) . '-' .  basename($file["name"]); 

        $target_file = $target_dir . $filename;

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $filename;
        } else {
            return "Error: Could not upload file";
        }
        
    }




    public function get_all_chef_data()
    {


        $stmt = $this->db->prepare("SELECT * FROM chefs");
        $stmt->execute();
        $chef = $stmt->fetchAll();

        return $chef;

    }




    public function get_chef_data($chef_id)
    {


        $stmt = $this->db->prepare("SELECT * FROM chefs WHERE id = :id");
        $stmt->bindParam(':id', $chef_id);

        $stmt->execute();
        $chef = $stmt->fetch();

        return $chef;

    }

    public function find_chef($data)
    {

        $email = $data["email"];
        $password = $data["password"];

        $stmt = $this->db->prepare("SELECT * FROM chefs WHERE email = :email");
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $chef = $stmt->fetch();

        // chef exists
        if (!$chef) {
            return false;
        }

        // Password matches

        if (password_verify($password, $chef['password'])) {
            return $chef;
        }

        return false;

    }


    public function update_chef_profile($data)
    {



        $id = $data['chef_id'];
        $first_name = $data["first_name"];
        $last_name = $data["last_name"];
        $email = $data["email"];
        $phone_number = $data["phone_number"];
        $specialization = $data["specialization"];
        $price_range = $data["price_range"];
        $experience_level = $data["experience_level"];
        $availability = $data["availability"];


        $stmt = $this->db->prepare("
                UPDATE chefs 
                SET 
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email, 
                phone_number = :phone_number, 
                specialization = :specialization, 
                price_range = :price_range, 
                experience_level = :experience_level, 
                availability = :availability 
                WHERE 
                id = :id");


        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':specialization', $specialization);
        $stmt->bindParam(':price_range', $price_range);
        $stmt->bindParam(':experience_level', $experience_level);
        $stmt->bindParam(':availability', $availability);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        // Get the updated chef data
        $stmt = $this->db->prepare("SELECT * FROM chefs WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $chef = $stmt->fetch();

        // Updated User
        return $chef;
    }



    public function delete_chef_data($chef_id)
    {

        $stmt = $this->db->prepare("DELETE FROM chefs WHERE id = :id");
        $stmt->bindParam(':id', $chef_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        
    }








}
