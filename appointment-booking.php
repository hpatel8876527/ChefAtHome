<?php

session_start();

if(!isset($_SESSION['user_data'])) {

    header("Location: login.php");
    exit;

}

if(!isset($_GET['chef_id'])) {

    header("Location: index.php");
    exit;
}

require('classes/db_connection.php');
require('classes/chef.php');
require('classes/booking.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$chef_obj = new Chef($db);

$chef_id = $_GET['chef_id'];
$chef = $chef_obj->get_chef_data($chef_id);



$dateError = $timeError = $phoneError = $addressError = $cardNumberError = $expiryDateError = $cvcError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["booking_date"])) {
        $dateError = "Booking date is required.";
    }

    if (empty($_POST["booking_time"])) {
        $timeError = "Booking time is required.";
    }


    if (empty($_POST["address"])) {
        $dateError = "Booking date is required.";
    }

    if (empty($_POST["address"])) {
        $timeError = "Booking time is required.";
    }


    // Phone number: /^[0-9]{10}$/ (10 digits)

    if (empty($_POST["phone"])) {
        $phoneError = "Phone number is required.";
    }

    if (empty($_POST["address"])) {
        $addressError = "Address is required.";
    }

    // Card number: /^[0-9]{16}$/ (16 digits)

    if (empty($_POST["card_number"])) {
        $cardNumberError = "Card number is required.";
    } elseif (!preg_match("/^[0-9]{16}$/", $_POST["card_number"])) {
        $cardNumberError = "Invalid card number format. Hint 16 digits.";
    }

    // Expiry date: /^(0[1-9]|1[0-2])\/[0-9]{2}$/ (MM/YY format)

    if (empty($_POST["expiry_date"])) {
        $expiryDateError = "Expiry date is required.";
    } elseif (!preg_match("/^(0[1-9]|1[0-2])\/[0-9]{2}$/", $_POST["expiry_date"])) {
        $expiryDateError = "Invalid expiry date format. Hint (MM/YY)";
    }

    // CVC: /^[0-9]{3}$/ (3 digits)

    if (empty($_POST["cvc"])) {
        $cvcError = "CVC is required.";
    } elseif (!preg_match("/^[0-9]{3}$/", $_POST["cvc"])) {
        $cvcError = "Invalid CVC format. Hint 3 digits";
    }

    if ($phoneError == ""
    && $dateError == ""
    && $timeError == ""
    && $addressError == ""
    && $cardNumberError == ""
    && $expiryDateError == ""
    && $cvcError == "") {

        // save booking info database

        $booking_data = [
        'user_id' => $_SESSION["user_data"]["id"],
        'chef_id' => $chef_id,
        'booking_date' => $_POST["booking_date"],
        'booking_time' => $_POST["booking_time"]
        ];

        $booking_obj = new Booking($db);

        $booking = $booking_obj->create_booking($booking_data);

        if($booking) {

            // go to confirmation page
            header('Location: booking-confirmation.php?booking_number='.$booking['booking_number']);
            exit;

        }



    }
}

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Chef At Home - Booking Checkout</title>
    <style>
        .booking-checkout-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        h2 {
            font-size: 32px;
            margin-bottom: 20px;
            width: 100%;
            text-align: center !important;
            text-shadow: 2px 2px 5px rgb(140, 0, 0);
        }

        .user-info,
        .chef-selection {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 46%;
            box-sizing: border-box;
            height: fit-content;
        }

        .user-info h3,
        .chef-selection h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .user-info label,
        .chef-selection label {
            display: block;
            margin-bottom: 10px;
        }

        .user-info input,
        .user-info textarea,
        .chef-selection input,
        select {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        .user-info textarea {
            height: 60px;
        }

        .book-appointment-btn {
            margin-top: 15px;
        }

        .booking-btn {
            display: none;
        }

        .chef {
            margin: 20px auto;
        }

        input:read-only:hover {
            cursor: not-allowed;
        }

        p {
            color: red;
            margin-top: -15px;
        }
    </style>
</head>

<body>
    <!-- Navbar Section -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <img src="images/logo.png" alt="Logo" />
                <h4>Chef At Home</h4>
            </div>
            <?php include('includes/nav.php'); ?>

        </div>
    </header>

    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?chef_id=<?php echo $chef_id; ?>" method="post">


    <section>
        <h2 class="booking-chechout-title">Appointment Booking</h2>

        <div class="booking-checkout-container">
            <!-- Chef Selection -->
            <div class="chef-selection">

                    <?php include('includes/chef-card.php'); ?>

                    <h3>Appointment Information</h3>

                    <input type="hidden"
                        value="<?php echo $chef_id; ?>"
                        name="chef_id">

                    <label>Choose Date<input type="date" name="booking_date"></label>

                    <p>
                        <?php echo $dateError; ?>
                    </p>

                    <label>Choose Time
                        <select name="booking_time">
                            <option value="">Choose Booking Time</option>
                            <option value="09:00">9:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="13:00">1:00 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                            <option value="17:00">5:00 PM</option>
                        </select>
                    </label>


                    <p>
                        <?php echo $timeError; ?>
                    </p>
            </div>

            <!-- User Information -->
            <div class="user-info">
                <h3>User Information</h3>


                <label>First Name <input type="text" name="first_name"
                        value="<?php echo $_SESSION['user_data']['first_name']; ?>"
                        readonly></label>


                <label>Last Name <input type="text" name="last_name"
                        value="<?php echo $_SESSION['user_data']['last_name']; ?>"
                        readonly></label>

                <label>Email <input type="email" name="email"
                        value="<?php echo $_SESSION['user_data']['email']; ?>"
                        readonly></label>

                <label>Phone Number <input type="tel" name="phone"
                        value="<?php echo $_SESSION['user_data']['phone_number'] ?? ''; ?>"></label>
                <p>
                    <?php echo $phoneError; ?>
                </p>


                <label>Address <textarea name="address"
                        value="<?php echo  $_POST['address'] ?? $_SESSION['user_data']['address']; ?>"></textarea></label>
                <p>
                    <?php echo $addressError; ?>
                </p>

                <h3>Payment Information</h3>

                <label>Card Number <input type="text" name="card_number"
                        value="<?php echo $_POST['card_number'] ?? '' ?>"></label>
                <p>
                    <?php echo $cardNumberError; ?>
                </p>


                <label>Expiry Date <input type="text" name="expiry_date"
                        value="<?php echo $_POST['expiry_date'] ?? '' ?>"></label>
                <p>
                    <?php echo $expiryDateError; ?>
                </p>

                <label>CVC <input type="text" name="cvc"
                        value="<?php echo $_POST['cvc'] ?? '' ?>"></label>
                <p>
                    <?php echo $cvcError; ?>
                </p>


                <button type="submit" class="book-appointment-btn">Complete Booking</button>
                
            </div>

        </div>

    </section>
    
</form>
        <!-- Footer Section -->
        <footer>
            <div class="footer-container">
                <div class="footer-content">
                    <div class="footer-logo">
                        <h3>Chef At Home</h3>
                        <img src="images/logo.png" alt="Logo" />
                    </div>
                    <div class="footer-info">
                        <h4>Contact Information</h4>
                        <p>1234 Main Street, City, Country</p>
                        <p>Phone: +1 123-456-7890</p>
                        <p>Email: info@chefathome.com</p>
                    </div>

                    <div class="footer-links">
                        <ul>
                            <li>
                                <strong><a href="#">Home</a></strong>
                            </li>
                            <li>
                                <strong><a href="#">About Us</a></strong>
                            </li>
                            <li>
                                <strong><a href="#">Chef Directory</a></strong>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="footer-bottom">
                    <div class="footer-bottom-center">
                        <p>&copy; 2023 Chef At Home. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
</body>


</html>