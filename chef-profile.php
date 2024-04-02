<?php


session_start();

if(!isset($_SESSION['chef_data'])){

    header('Location: index.php');
    exit;
}

require('classes/db_connection.php');
require('classes/chef.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

// logged in chef
$chef_id = $_SESSION['chef_data']['id'];

$chef_obj = new Chef($db);

// chef data
$chef = $chef_obj->get_chef_data($chef_id);


$availabilityError = $firstNameError = $lastNameError = $emailError = $phoneError = $experienceError = $specializationError = $priceRangeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


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


        $db_conn = new DbConnection();
        $db = $db_conn->get_db_conn();

        $chef_obj = new Chef($db);
        $chef = $chef_obj->update_chef_profile($_POST);

        $_SESSION["chef_data"] = $chef;

        header("Location: chef-profile.php?msg=success");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css" />

    <style>


        /* Additional Registration Styles */
        .registration-card {
            background-color: rgba(168, 149, 149, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            width: 500px;
            box-sizing: border-box;
            text-align: center;
        }

        .registration-card form {
            text-align: left;
        }

        .registration-card label {
            display: block;
            margin-bottom: 8px;
        }

        .registration-card input, select {
            width: 90%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            outline: none;
        }

        select{
            width: 95%;
        }

        .star,
         .registration-card input + p,
         .registration-card select + p {
            color: #dc2626;
            margin-top: 6px;
         }


        .registration-card a {
            color: #333;
            text-decoration: none;
        }

        .registration-card a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>


    <div class="container">
        <div class="registration-card">

            <h2>Chef Profile</h2>

            <?php

                if(isset($_GET["msg"]) && $_GET["msg"] == "success") {
                    echo '<p class="star"><strong>Chef Profile Updated.</strong><p>';
                }

                ?>

            <!-- chef Registeration -->

            
            <form
            action="<?php echo $_SERVER['PHP_SELF']; ?>"
            method="post" enctype="multipart/form-data">
            
               <img src="images/<?php echo $chef['img_url'] ?>" alt="" width="200px" style="display: block; margin: auto;">


               <input type="hidden" name="chef_id" value="<?php echo $chef['id'] ?>" />

                <label for="first_name" class="form-label">First Name <sup class="star">*</sup></label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $chef['first_name'] ?>">
                <p><?php echo $firstNameError; ?></p>


                <label for="last_name" class="form-label">Last Name <sup class="star">*</sup></label>
                <input type="text" id="last_name" name="last_name"
                value="<?php echo $chef['last_name'] ?>">
                <p>
                    <?php echo $lastNameError; ?>
                </p>


                <label for="email" class="form-label">Email <sup class="star">*</sup></label>
                <input type="email" id="email" name="email"
                value="<?php echo $chef['email'] ?>">
                <p>
                    <?php echo $emailError; ?>
                </p>




                <label for="phone_number" class="form-label">Phone Number <sup class="star">*</sup></label>
                <input type="text" id="phone_number" name="phone_number"
                value="<?php echo $chef['phone_number'] ?>">

                <p>
                    <?php echo $phoneError; ?>
                </p>


                <label for="specialization" class="form-label">Specialization <sup class="star">*</sup></label>
                <input type="text" id="specialization" name="specialization" 
                value="<?php echo $chef['specialization'] ?>"/>
                <p>
                    <?php echo $specializationError; ?>
                </p>

                <label for="price_range" class="form-label">Price Range <sup class="star">*</sup></label>
                <select name="price_range">
                <option value="$20 - $35 per dish" <?php echo $chef['price_range'] == "$20 - $35 per dish" ? 'selected' : '';  ?>>$20 - $35 per dish</option>
                <option value="$20 - $40 per dish" <?php echo $chef['price_range'] == "$20 - $40 per dish" ? 'selected' : '';  ?>>$20 - $40 per dish</option>
                <option value="$30 - $40 per dish" <?php echo $chef['price_range'] == "$30 - $40 per dish" ? 'selected' : '';  ?>>$30 - $40 per dish</option>
                <option value="$40 - $50 per dish" <?php echo $chef['price_range'] == "$40 - $50 per dish" ? 'selected' : '';  ?>>$40 - $50 per dish</option>
                </select>
                <p>
                    <?php echo $priceRangeError; ?>
                </p>




                <label for="experience_level" class="form-label">Experience Level <sup class="star">*</sup></label>
                <select name="experience_level">
                <option value="Master Chef" <?php echo $chef['experience_level'] == "Master Chef" ? 'selected' : '';  ?>>Master Chef</option>
                <option value="Head Chef" <?php echo $chef['experience_level'] == "Head Chef" ? 'selected' : '';  ?>>Head Chef</option>
                <option value="Executive Chef" <?php echo $chef['experience_level'] == "Executive Chef" ? 'selected' : '';  ?>>Executive Chef</option>
                <option value="Chef de Partie" <?php echo $chef['experience_level'] == "Chef de Partie" ? 'selected' : '';  ?>>Chef de Partie</option>
                <option value="Sous Chef" <?php echo $chef['experience_level'] == "Sous Chef" ? 'selected' : '';  ?>>Sous Chef</option>
                </select>

                
                <p>
                    <?php echo $experienceError; ?>
                </p>

                                
                <label for="availability" class="form-label">Availability <sup class="star">*</sup></label>
                <input type="text" id="availability" name="availability" placeholder="Flexible"
                value=" <?php echo $chef['availability'];  ?>">
                <p>
                    <?php echo $availabilityError; ?>
                </p>

            

                <button type="submit" class="book-appointment-btn">Update Profile</button>

            </form>


            
            <p>
                <a href="index.php"><strong>Back to Home</strong></a>
            </p>
        </div>
    </div>
</body>

</html>