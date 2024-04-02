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


$user_id = $_GET['user_id'] ?? null;

$user_obj = new User($db);

// user data
$user = $user_obj->get_user_data($user_id);




$firstNameError = $lastNameError = $emailError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {



    if (empty($_POST["first_name"])) {
        $firstNameError = "First Name is required.";
    }

    if (empty($_POST["last_name"])) {
        $lastNameError = "Last Name is required.";
    }

    if (empty($_POST["email"])) {
        $emailError = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    if ($firstNameError == "" && $lastNameError == "" && $emailError == "") {


        $user = $user_obj->update_user_profile($_POST);

        header("Location: user-edit.php?user_id=" . $_POST['id'] . "&msg=success");
        exit;
    }
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
            <div class="col-lg-8" id="dashboard-content">

                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold">Edit User</span>
                    </div>
                    <div class="card-body">

                    
                        <?php

                        // edit message
                        if(isset($_GET["msg"]) && $_GET["msg"] == "success") {
                        echo '<p style="color:green;"><strong>User Updated Successfully.</strong><p>';
                        }

                        ?>


                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


                            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">

                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name <sup class="text-danger">*</sup></label>
                                <input value="<?php echo $user['first_name']; ?>" type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name <sup class="text-danger">*</sup></label>
                                <input  value="<?php echo $user['last_name']; ?>" type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <sup class="text-danger">*</sup></label>
                                <input  value="<?php echo $user['email']; ?>" type="email" class="form-control" id="email" name="email" required>
                            </div>


                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input  value="<?php echo $user['phone_number']; ?>" type="text" class="form-control" id="phone_number" name="phone_number">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input  value="<?php echo $user['address']; ?>" type="text" class="form-control" id="address" name="address">
                            </div>

                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>


                    </div>
                </div>


            </div>

        </div>
    </div>


</main>



<?php include 'includes/footer.php'; ?>