<?php

session_start();

$firstNameError = $lastNameError = $emailError = $passwordError = "";

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

    if ($firstNameError == "" && $lastNameError == "" && $emailError == "" && $passwordError == "") {

        require('classes/db_connection.php');
        require('classes/user.php');

        $db_conn = new DbConnection();
        $db = $db_conn->get_db_conn();

        $user_obj = new User($db);
        $user = $user_obj->create_user($_POST);

        $_SESSION["user_data"] = $user;

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

        .registration-card input {
            width: 90%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 4px;
            outline: none;
        }

        .star,
         .registration-card input + p {
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

            <h2>User Registration</h2>

            <!-- User Registeration -->

            <form
                action="<?php echo $_SERVER['PHP_SELF']; ?>"
                method="post">

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


                <label for="password" class="form-label">Password <sup class="star">*</sup></label>
                <input type="password" id="password" name="password">
                <p>
                    <?php echo $passwordError; ?>
                </p>


                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number">

                <p></p>


                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" />

                <p></p>


                <button type="submit" class="book-appointment-btn">Register</button>
            </form>

            <p class="home-page-title">
                Already have an account?
                <a href="login.php"><strong>Login</strong></a>
            </p>

            
            <p>
                <a href="index.php"><strong>Back to Home</strong></a>
            </p>
        </div>
    </div>
</body>

</html>