<?php 

session_start(); 


if(!isset($_SESSION['chef_data'])){
   
    header("Location: login.php");
    exit;
    
}


require('classes/db_connection.php');
require('classes/chef.php');
require('classes/booking.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$booking_obj = new Booking($db);

$chef_id = $_SESSION['chef_data']['id'];

$bookings = $booking_obj->get_chef_bookings_data($chef_id);

//echo var_dump($bookings);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .about-container {
            max-width: 900px;
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

        <h3>My Appointment Bookings</h3>
             
             <?php if($bookings): ?>

                <table>

                   <thead>
                    <th>Booking Number</th>
                    <th>Appointment Booking Date & Time</th>
                    <th>Customer Name</th>
                    <th>Customer Contact Details</th>
                    <th>Address</th>
                    <th>Payment Status</th>
                   </thead>

                   <tbody>
                         
                   
                <?php foreach($bookings as $booking): ?>

                <tr>
                    <td>
                     <span style="background-color: rgb(140 0 0 / 26%); padding: 4px;">
                    <?php echo $booking['booking_number'] ?>
                    </span>    
                </td>
                    <td><?php echo date('d F, Y', strtotime($booking['date'])) . ', ' . $booking['time'];  ?></td>
                    <td><?php echo $booking['first_name'] . ' ' . $booking['last_name']; ?></td>
                    <td>
                        <?php echo 'Phone No. - ' . $booking['phone_number'] . ',<br><br>'; ?>
                        <?php echo 'Email Address -' . $booking['email']; ?>
                </td>
                <td>
                <?php echo $booking['address']; ?>

                </td>
                <td>
                <?php echo $booking['payment_status']; ?>

                </td>
                </tr>    

                <?php endforeach; ?>



                   </tbody>
                </table>



             <?php else: ?>
                <p>No Bookings</p>
             <?php endif; ?>
        
            
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