<?php

session_start();

if(!isset($_SESSION['admin'])){
   
    header("Location: index.php");
    exit;
    
}



require('classes/db_connection.php');
require('classes/message.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$message_obj = new Message($db);

$messages = $message_obj->get_all_message_data();

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

               <h4 class="mb-3">Contact Messages</h4>


                <div class="table-responsive">

                   <!-- messages Data -->
                    <table class="table table-bordered table-striped small" style="min-width: 50rem;">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Message</th>
                                <th>Messaged At</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach($messages as $message): ?>

                                <tr>
                                    <td width="100"><?php echo $message['full_name']; ?></td>
                                    <td width="100"><?php echo $message['email']; ?></td>
                                    <td width="200"><?php echo $message['message']; ?></td>
                                    <td width="100"><?php echo date('d M, Y', strtotime($message['created_at'])); ?></td>
                                    
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