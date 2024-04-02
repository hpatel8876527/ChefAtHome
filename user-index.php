<?php

session_start();

if(!isset($_SESSION['admin'])){
   
    header("Location: index.php");
    exit;
    
}


require('classes/db_connection.php');
require('classes/user.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$user_obj = new User($db);

$users = $user_obj->get_all_user_data();


if(isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){
   
    // delete user
    $user_obj->delete_user_data($_GET['user_id']);
    
    header("Location: user-index.php?msg=delete");
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

               <h4 class="mb-3">Users</h4>

               <?php

                // delete message
                if(isset($_GET["msg"]) && $_GET["msg"] == "delete") {
                echo '<p style="color:red;"><strong>User Deleted Successfully.</strong><p>';
                }

                ?>


                <div class="table-responsive">

                   <!-- Users Data -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach($users as $user): ?>

                                <tr>
                                    <td><?php echo $user['first_name']; ?></td>
                                    <td><?php echo $user['last_name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['phone_number']; ?></td>
                                    <td><?php echo $user['address']; ?></td>
                                    <td>

                                    <?php // edit and delete ?>

                                    <a href="user-edit.php?user_id=<?php echo $user['id']; ?>">Edit</a>
                                    |
                                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?user_id=<?php echo $user['id']; ?>&action=delete">Delete</a>

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