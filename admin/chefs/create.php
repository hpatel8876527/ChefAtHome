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
                        <span class="fw-bold">New Chef</span>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="chefName" class="form-label">Chef Name</label>
                                <input type="text" class="form-control" id="chefName" required>
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
                                <label for="experienceLevel" class="form-label">Experience Level</label>
                                <input type="text" class="form-control" id="experienceLevel" required>

                            </div>

                            <div class="mb-3">
                                <label for="specialization" class="form-label">Specialization</label>
                                <input type="text" class="form-control" id="specialization" required>
                            </div>

                            <div class="mb-3">
                                <label for="signatureDish" class="form-label">Signature Dish</label>
                                <input type="text" class="form-control" id="signatureDish" required>
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