<?php

session_start();

$emailError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
        $emailError = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required.";
    }

    if ($emailError == "" && $passwordError == "") {

        require('classes/db_connection.php');
        require('classes/chef.php');

        $db_conn = new DbConnection();
        $db = $db_conn->get_db_conn();

        $chef = new Chef($db);
        $chef_data = $chef->find_chef($_POST);

        if ($chef_data) {    
            $_SESSION["chef_data"] = $chef_data;
            header("Location: index.php");
            exit;

        } else {
            header("Location: chef-login.php?msg=invalid");
            exit;

        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />

    <title>Login</title>
    <style>
        
        /* Additional Login Styles */
        .login-card {
            background-color: rgba(168, 149, 149, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            width: 500px;
            box-sizing: border-box;
            text-align: center;
        }

        .login-card form {
            text-align: left;
        }


        .login-card label {
            display: block;
            margin-bottom: 8px;
        }

        .login-card input {
            width: 90%;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
        }

        .login-card a {
            color: #333;
            text-decoration: none;
        }

        .login-card a:hover {
            text-decoration: underline;
        }

        .star,
        .login-card input + p {
            color: #dc2626;
            margin-top: 6px;
         }

    </style>
</head>

<body>

    <div class="container">
        <div class="login-card">
            
            <h2>Chef Login</h2>

            <?php

                if(isset($_GET["msg"]) && $_GET["msg"] == "invalid") {
                    echo '<p class="star"><strong>Email or Password is Incorrect.</strong><p>';
                }

            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


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
                <button type="submit" class="book-appointment-btn">Login</button>
            </form>

            <?php // <p><a href="forgot-password.php"><strong>Forgot Password?</strong></a></p>?>

            <p class="home-page-title">
                Don't have an account?
                <a href="chef-register.php"><strong>Register</strong></a>
            </p>

            
            <p>
                <a href="index.php"><strong>Back to Home</strong></a>
            </p>
        </div>
    </div>
</body>


</html>