<?php

session_start();

require '../functions.php';

// Redirect if Admin is not logged In
if(isAdminLoggedIn() == false){

    header('Location: /admin');
    exit;

}



include '../includes/header.php';

?>

<!-- Dashboard UI -->
<main>

    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3" id="sidebar">
                <?php include '../includes/sidebar.php'; ?>
            </div>


            <!-- Dashboard Content -->
            <div class="col-lg-9" id="dashboard-content">

                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold">New User</span>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>

                            <div class="mb-3">
                                <label for="preferredCuisine" class="form-label">Preferred Cuisine</label>
                                <textarea class="form-control" id="preferredCuisine" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>


            </div>

        </div>
    </div>


</main>



<?php include '../includes/footer.php'; ?>