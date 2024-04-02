<?php 

session_start();


if(!isset($_SESSION['admin'])){

    header('Location: admin-login.php');
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

                <h4 class="mb-3">Dashboard</h4>

                <div class="alert alert-primary mb-4">
                    Welcome Back Admin. 
                    <span class="fw-bold"><?php echo $_SESSION['admin']['username'] . " | " . $_SESSION['admin']['email']; ?></span>
                </div>

                <div class="row">
                    <!-- Card  -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Users</h5>
                                <a href="user-index.php" class="btn btn-primary">View Users</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card  -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Chefs</h5>
                                <a href="chef-index.php" class="btn btn-primary">View Chefs</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card  -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Bookings</h5>
                                <a href="booking-index.php" class="btn btn-primary">View Bookings</a>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Card  -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Messages</h5>
                                <a href="message-index.php" class="btn btn-primary">View Messages</a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>


</main>


<?php include 'includes/footer.php'; ?>