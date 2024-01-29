<?php 

session_start();

require './functions.php';

// Redirect if Admin is not logged In
if(isAdminLoggedIn() == false){

    header('Location: /admin');
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
                    <span class="fw-bold"><?php echo $_SESSION['admin']['name']; ?></span>
                </div>

                <div class="row">
                    <!-- Card  -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Users</h5>
                                <a href="/admin/users" class="btn btn-primary">View Users</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card  -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Chefs</h5>
                                <a href="#" class="btn btn-primary">View Chefs</a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>


</main>


<?php include 'includes/footer.php'; ?>