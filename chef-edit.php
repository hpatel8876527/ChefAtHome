<?php

session_start();

if(!isset($_SESSION['admin'])) {

    header("Location: index.php");
    exit;

}

require('classes/db_connection.php');
require('classes/chef.php');



$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();


$chef_id = $_GET['chef_id'] ?? null;

$chef_obj = new Chef($db);

// chef data
$chef = $chef_obj->get_chef_data($chef_id);



$availabilityError = $firstNameError = $lastNameError = $emailError = $phoneError = $experienceError = $specializationError = $priceRangeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chef_id'])) {


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


    if (empty($_POST["phone_number"])) {
        $phoneError = "Phone Number is required.";
    }

    if (empty($_POST["specialization"])) {
        $specializationError = "Specialization is required.";
    }


    if (empty($_POST["availability"])) {
        $availabilityError = "Availability is required.";
    }

    

    if (empty($_POST["price_range"])) {
        $priceRangeError = "Price range is required.";
    }

    

    if (empty($_POST["experience_level"])) {
        $experienceError = "Experience level is required.";
    }


    if (
        $firstNameError == "" 
        && $lastNameError == "" 
        && $emailError == "" 
        && $phoneError == ""
        && $experienceError == ""
        && $specializationError == ""
        && $priceRangeError == ""
        && $availabilityError == ""
        
        ) {

        $chef = $chef_obj->update_chef_profile($_POST);

        header("Location: chef-edit.php?chef_id=" . $_POST['chef_id'] . "&msg=success");
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
            <div class="col-lg-9" id="dashboard-content">

                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold">Edit Chef</span>
                    </div>
                    <div class="card-body">


                    <?php

// edit message
if(isset($_GET["msg"]) && $_GET["msg"] == "success") {
echo '<p style="color:green;"><strong>Chef Updated Successfully.</strong><p>';
}

?>

                        <form
                            action="<?php echo $_SERVER['PHP_SELF']; ?>"
                            method="post" enctype="multipart/form-data">

                            <!--<div class="mb-3 text-center">
                                <img src="images/<?php #echo $chef['img_url'] ?>"
                                    alt="" width="200px" class="border p-1">
                            </div>
                              -->

                            <input type="hidden" name="chef_id"
                                value="<?php echo $chef['id'] ?>" />

                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="<?php echo $chef['first_name'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="<?php echo $chef['last_name'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <sup class="text-danger">*</sup></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?php echo $chef['email'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="<?php echo $chef['phone_number'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="specialization" class="form-label">Specialization <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="specialization" name="specialization"
                                    value="<?php echo $chef['specialization'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="price_range" class="form-label">Price Range <sup
                                        class="text-danger">*</sup></label>
                                <select name="price_range" class="form-select">
                                    <option value="$20 - $35 per dish" <?php echo $chef['price_range'] == "$20 - $35 per dish" ? 'selected' : '';  ?>>$20
                                        - $35 per dish</option>
                                    <option value="$20 - $40 per dish" <?php echo $chef['price_range'] == "$20 - $40 per dish" ? 'selected' : '';  ?>>$20
                                        - $40 per dish</option>
                                    <option value="$30 - $40 per dish" <?php echo $chef['price_range'] == "$30 - $40 per dish" ? 'selected' : '';  ?>>$30
                                        - $40 per dish</option>
                                    <option value="$40 - $50 per dish" <?php echo $chef['price_range'] == "$40 - $50 per dish" ? 'selected' : '';  ?>>$40
                                        - $50 per dish</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="experience_level" class="form-label">Experience Level <sup
                                        class="text-danger">*</sup></label>
                                <select name="experience_level" class="form-select">
                                    <option value="Master Chef" <?php echo $chef['experience_level'] == "Master Chef" ? 'selected' : '';  ?>>Master
                                        Chef</option>
                                    <option value="Head Chef" <?php echo $chef['experience_level'] == "Head Chef" ? 'selected' : '';  ?>>Head
                                        Chef</option>
                                    <option value="Executive Chef" <?php echo $chef['experience_level'] == "Executive Chef" ? 'selected' : '';  ?>>Executive
                                        Chef</option>
                                    <option value="Chef de Partie" <?php echo $chef['experience_level'] == "Chef de Partie" ? 'selected' : '';  ?>>Chef
                                        de Partie</option>
                                    <option value="Sous Chef" <?php echo $chef['experience_level'] == "Sous Chef" ? 'selected' : '';  ?>>Sous
                                        Chef</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="availability" class="form-label">Availability <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" class="form-control" id="availability" name="availability"
                                    placeholder="Flexible"
                                    value="<?php echo $chef['availability']; ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>

                        </form>


                    </div>
                </div>


            </div>

        </div>
    </div>


</main>



<?php include 'includes/footer.php'; ?>