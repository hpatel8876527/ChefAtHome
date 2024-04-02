<?php

session_start();

$imgUrlError = $availabilityError = $firstNameError = $lastNameError = $emailError = $passwordError = $phoneError = $experienceError = $specializationError = $priceRangeError = "";

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

    if (empty($_POST["password"])) {
        $passwordError = "Password is required.";
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


    if (empty($_FILES["img_url"])) {
        $imgUrlError = "Profile image is required.";
    }

    if (
        $firstNameError == "" 
        && $lastNameError == "" 
        && $emailError == "" 
        && $passwordError == ""
        && $phoneError == ""
        && $experienceError == ""
        && $specializationError == ""
        && $priceRangeError == ""
        && $availabilityError == ""
        && $imgUrlError == ""
        
        ) {


        require('classes/db_connection.php');
        require('classes/chef.php');

        $db_conn = new DbConnection();
        $db = $db_conn->get_db_conn();

        $chef_obj = new Chef($db);
        $chef = $chef_obj->create_chef($_POST, $_FILES);

        $_SESSION["chef_data"] = $chef;

        header("Location: index.php");
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

            <h2>Chef Registration</h2>

            <!-- User Registeration -->

            <form
                action="<?php echo $_SERVER['PHP_SELF']; ?>"
                method="post" enctype="multipart/form-data">

                <label for="first_name" class="form-label">First Name <sup class="star">*</sup></label>
                <input type="text" id="first_name" name="first_name">
                <p><?php echo $firstNameError; ?></p>


                <label for="last_name" class="form-label">Last Name <sup class="star">*</sup></label>
                <input type="text" id="last_name" name="last_name">
                <p>
                    <?php echo $lastNameError; ?>
                </p>


                <label for="email" class="form-label">Email <sup class="star">*</sup></label>
                <input type="email" id="email" name="email">
                <p>
                    <?php echo $emailError; ?>
                </p>




                <label for="phone_number" class="form-label">Phone Number <sup class="star">*</sup></label>
                <input type="text" id="phone_number" name="phone_number">

                <p>
                    <?php echo $phoneError; ?>
                </p>


                <label for="specialization" class="form-label">Specialization <sup class="star">*</sup></label>
                <input type="text" id="specialization" name="specialization" />
                <p>
                    <?php echo $specializationError; ?>
                </p>

                <label for="price_range" class="form-label">Price Range <sup class="star">*</sup></label>
                <select name="price_range">
                <option value="">Choose Price Range</option>
                <option value="$20 - $35 per dish">$20 - $35 per dish</option>
                <option value="$20 - $40 per dish">$20 - $40 per dish</option>
                <option value="$30 - $40 per dish">$30 - $40 per dish</option>
                <option value="$40 - $50 per dish">$40 - $50 per dish</option>
                </select>
                <p>
                    <?php echo $priceRangeError; ?>
                </p>


                <label for="experience_level" class="form-label">Experience Level <sup class="star">*</sup></label>
                <select name="experience_level">
                <option value="">Choose Experience Level</option>
                <option value="Master Chef">Master Chef</option>
                <option value="Head Chef">Head Chef</option>
                <option value="Executive Chef">Executive Chef</option>
                <option value="Chef de Partie">Chef de Partie</option>
                <option value="Sous Chef">Sous Chef</option>
                </select>

                
                <p>
                    <?php echo $experienceError; ?>
                </p>

                                
                <label for="availability" class="form-label">Availability <sup class="star">*</sup></label>
                <input type="text" id="availability" name="availability" placeholder="Flexible">
                <p>
                    <?php echo $availabilityError; ?>
                </p>

                
                <label for="img_url" class="form-label">Profile Image <sup class="star">*</sup></label>
                <input type="file" id="img_url" name="img_url">
                <p>
                    <?php echo $imgUrlError; ?>
                </p>


               
                
                <label for="password" class="form-label">Password <sup class="star">*</sup></label>
                <input type="password" id="password" name="password">
                <p>
                    <?php echo $passwordError; ?>
                </p>



                <button type="submit" class="book-appointment-btn">Register</button>
            </form>

            <p class="home-page-title">
                Already have an account?
                <a href="chef-login.php"><strong>Login</strong></a>
            </p>

            
            <p>
                <a href="index.php"><strong>Back to Home</strong></a>
            </p>
        </div>
    </div>
</body>

</html>