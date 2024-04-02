<?php 

session_start(); 


if(!isset($_SESSION['user_data'])){
   
    header("Location: login.php");
    exit;
    
}

if(!isset($_GET['booking_number'])){
   
    header("Location: index.php");
    exit;
}


require('classes/db_connection.php');
require('classes/chef.php');
require('classes/booking.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$booking_obj = new Booking($db);

$booking_number = $_GET['booking_number'];
$booking = $booking_obj->get_booking_data($booking_number);




$chef_obj = new Chef($db);
$chef = $chef_obj->get_chef_data($booking['chef_id']);





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .about-container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .about-us h2 {
            color: #333;
            border-bottom: 2px solid rgb(140, 0, 0);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .about-us p {
            line-height: 1.6;
            color: #555;
        }

        .about-us h3 {
            color: rgb(140, 0, 0);
            margin-top: 20px;
            font-size: 1.5rem;
        }

        .about-us ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .about-us li {
            margin-bottom: 8px;
        }

        .about-us img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

/* CSS */
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid black;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

@media print {
  .print-d-none {
    display: none;
  }
}


    </style>
</head>

<body>
    <!-- Navbar Section -->
    <header class="navbar print-d-none">
        <div class="navbar-container">
            <div class="logo">
                <img src="images/logo.png" alt="Logo" />
                <h4>Chef At Home</h4>
            </div>
            <?php include('includes/nav.php'); ?>
            

        </div>
    </header>
    <!-- About Us Section -->
    <div class="about-container">
        <div class="about-us">

        <h3>Appointment Booking Confirmation</h3>
             
            <table style="text-align: left;">
                <thead>
                    <tr>
                        <th>Appointment Booking Number</th>
                        <td>
                            
                        <span style="background-color: rgb(140 0 0 / 26%); padding: 4px;"
                        ><?php echo $booking['booking_number']; ?></span>

                        </td>
                    </tr>

                    <tr>
                    <th>Appointment Date</th>
                    <td><?php echo date('d F, Y', strtotime($booking['date'])); ?></td>
                    </tr>

                    <tr>
                        
                    <th>Appointment Time</th>
                    <td><?php echo $booking['time'] ; ?></td>
                    </tr>


                    <tr>
                        
                    <th>Chef Name</th>
                    <td><?php echo $chef['first_name'] . ' ' . $chef['last_name'];  ?></td>
                    </tr>

                    <tr>
                        
                    <th>Chef Phone Number</th>
                    <td><?php echo $chef['phone_number']; ?></td>
                    </tr>

                    <tr>
                        
                    <th>Chef Email Address</th>
                    <td><?php echo $chef['email']; ?></td>
                    </tr>



                </thead>

            </table>

            <a href="#" class="book-appointment-btn" style="width: 100px; text-align: center"
            onclick="return print();"
            >Print</a>

            
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="">
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