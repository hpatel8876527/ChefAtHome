<?php

session_start();

if(!isset($_SESSION['admin'])){
   
    header("Location: index.php");
    exit;
    
}



require('classes/db_connection.php');
require('classes/booking.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$booking_obj = new Booking($db);
$bookings = $booking_obj->get_all_booking_data();

include 'includes/header.php';


?>

<!-- Dashboard UI -->
<main>

    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3" id="sidebar">
                <?php include 'includes/sidebar.php'; ?>
            </div>


            <!-- Dashboard Content -->
            <div class="col-lg-9" id="dashboard-content">

               <h4 class="mb-3">Appointment Bookings</h4>


                <div class="table-responsive">

                   <!-- bookings Data -->
                    <table class="table table-bordered table-striped small" style="min-width: 60rem;">
                        <thead >
                            <tr>
                                <th>Booking Number</th>
                                <th>Booking Date</th>
                              
                                <th>Customer Name</th>
                                <th>Customer Contact Details</th>

                                <th>Chef Name</th>
                                <th>Chef Contact Details</th>

                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach($bookings as $booking): ?>

                                <tr>
                                    <td><?php echo $booking['booking_number']; ?></td>

                                    <td>
                                    
                                       <?php echo date('d M, Y', strtotime($booking['booking_date'])); ?>
                                       <?php echo ',' .  $booking['booking_time']; ?>
                                    
                                    </td>
                                    
                                    <td><?php echo $booking['customer_name']; ?></td>
                                    
                                    
                                    <td>
                                    
                                        <?php echo $booking['customer_phone_number']; ?>
                                        <?php echo ' | ' . $booking['customer_email']; ?>
                                    
                                    </td>

                                    
                                    <td><?php echo $booking['chef_name']; ?></td>

                                    <td>
                                        <?php echo $booking['chef_phone_number']; ?>
                                        <?php echo ' | ' . $booking['chef_email']; ?>
                                    </td>
                                    
                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>


            </div>

        </div>
    </div>


</main>



<?php include 'includes/footer.php'; ?>