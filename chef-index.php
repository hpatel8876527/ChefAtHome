<?php

session_start();

if(!isset($_SESSION['admin'])){
   
    header("Location: index.php");
    exit;
    
}



require('classes/db_connection.php');
require('classes/chef.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$chef_obj = new chef($db);

$chefs = $chef_obj->get_all_chef_data();

if(isset($_GET['chef_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){
   
    // delete chef
    $chef_obj->delete_chef_data($_GET['chef_id']);
    
    header("Location: chef-index.php?msg=delete");
    exit;
    
}




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

               <h4 class="mb-3">Chefs</h4>

               <?php

                // delete message
                if(isset($_GET["msg"]) && $_GET["msg"] == "delete") {
                echo '<p style="color:red;"><strong>Chef Deleted Successfully.</strong><p>';
                }

                ?>



                <div class="table-responsive">

                   <!-- chefs Data -->
                    <table class="table table-bordered table-striped small" style="min-width: 70rem;">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Phone</th>
                                <th>Specialization</th>
                                <th>Price Range</th>
                                <th>Experience Level</th>
                                <th>Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach($chefs as $chef): ?>

                                <tr>
                                    <td><?php echo $chef['first_name']; ?></td>
                                    <td><?php echo $chef['last_name']; ?></td>
                                    <td><?php echo $chef['email']; ?></td>
                                    <td><?php echo $chef['phone_number']; ?></td>
                                    <td><?php echo $chef['specialization']; ?></td>
                                    <td><?php echo $chef['price_range']; ?></td>
                                    <td><?php echo $chef['experience_level']; ?></td>
                                    <td><?php echo $chef['availability']; ?></td>

                                    <td>

                                    <?php // edit and delete ?>

                                    <a href="chef-edit.php?chef_id=<?php echo $chef['id']; ?>">Edit</a>
                                    |
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?chef_id=<?php echo $chef['id']; ?>&action=delete">Delete</a>

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