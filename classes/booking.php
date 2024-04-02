<?php


class Booking
{
    private $db;

    public function __construct(PDO $conn)
    {
        $this->db = $conn;
    }

    public function create_booking($data)
    {

        $booking_number = uniqid() . mt_rand(10000, 99999);

        $user_id = $data["user_id"];
        $chef_id = $data["chef_id"];
        $date = $data["booking_date"];
        $time = $data["booking_time"];
        $payment_status = $data["payment_status"] ?? 'Paid';
        $booking_status = $data["booking_status"] ?? 'Confirmed';

    
        $stmt = $this->db->prepare("
        INSERT INTO bookings 
        (booking_number, user_id, chef_id, date, time, payment_status, booking_status) 
        VALUES 
        (:booking_number, :user_id, :chef_id, :date, :time, :payment_status, :booking_status)");
        $stmt->bindParam(':booking_number', $booking_number);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':chef_id', $chef_id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':payment_status', $payment_status);
        $stmt->bindParam(':booking_status', $booking_status);
    
        $stmt->execute();
    
        // Get the ID of the last inserted record
        $lastInsertedId = $this->db->lastInsertId();
    
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE id = :id");
        $stmt->bindParam(':id', $lastInsertedId);
        $stmt->execute();
    
        $booking = $stmt->fetch();
    
        return $booking;
    }
    


    public function get_booking_data($booking_number)
    {


        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE booking_number = :booking_number");
        $stmt->bindParam(':booking_number', $booking_number);

        $stmt->execute();
        $user = $stmt->fetch();

        return $user;

    }


    
    public function get_user_bookings_data($user_id)
    {


        $stmt = $this->db->prepare("
        SELECT * FROM bookings 
        JOIN chefs ON chefs.id = bookings.chef_id
        
        WHERE user_id = :user_id
        
        ");
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();
        $user = $stmt->fetchAll();

        return $user;

    }


    public function get_chef_bookings_data($chef_id)
    {


        $stmt = $this->db->prepare("
        SELECT * FROM bookings 
        JOIN users ON users.id = bookings.user_id
        
        WHERE chef_id = :chef_id
        
        ");
        $stmt->bindParam(':chef_id', $chef_id);

        $stmt->execute();
        $user = $stmt->fetchAll();

        return $user;

    }

    public function get_all_booking_data()
    {


        $stmt = $this->db->prepare("
            SELECT 
                b.id AS booking_id,
                b.booking_number,
                b.date AS booking_date,
                b.time AS booking_time,

                CONCAT(u.first_name, ' ', u.last_name) AS customer_name,
                u.phone_number AS customer_phone_number,
                u.email AS customer_email,
                
                CONCAT(c.first_name, ' ', c.last_name) AS chef_name,
                c.phone_number AS chef_phone_number,
                c.email AS chef_email
            FROM 
                bookings b
            JOIN 
                users u ON b.user_id = u.id
            JOIN 
                chefs c ON b.chef_id = c.id;
        ");

        
        $stmt->execute();

        return $stmt->fetchAll();


    }





}
