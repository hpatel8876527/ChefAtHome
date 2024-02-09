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

               <h4 class="mb-3">Users</h4>

               <a href="/admin/users/create.php" class="btn btn-success mb-3">Add User</a>

                <div class="table-responsive">

                   <!-- Users Data -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email Address</th>
                                <th>Phone</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>john doe</td>
                                <td>john.doe@example.com</td>
                                <td>(555) 123-4567</td>
                                <td>
                                    <a href="/admin/users/edit.php" class="btn btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>jane smith</td>
                                <td>jane.smith@example.com</td>
                                <td>(555) 987-6543</td>
                                <td>
                                    <a href="/admin/users/edit.php" class="btn btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>alice jones</td>
                                <td>alice.jones@example.com</td>
                                <td>(555) 876-5432</td>
                                <td>
                                    <a href="/admin/users/edit.php" class="btn btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>bob rogers</td>
                                <td>bob.rogers@example.com</td>
                                <td>(555) 234-5678</td>
                                <td>
                                    <a href="/admin/users/edit.php" class="btn btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>sara miller</td>
                                <td>sara.miller@example.com</td>
                                <td>(555) 345-6789</td>
                                <td>
                                    <a href="/admin/users/edit.php" class="btn btn-primary me-1">Edit</a>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>


            </div>

        </div>
    </div>


</main>



<?php include '../includes/footer.php'; ?>