<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/forgot-password.css" />
    <title>Forgot Password</title>
</head>

<body>


    <div class="container">
        <div class="forgot-password-card">
            <h2>Forgot Password</h2>
            <?php
            $emailError = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["email"];

                if (empty($email)) {
                    $emailError = "Email is required";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format";
                } else {
                    echo '<p style="color: green;">Password reset email sent to ' . $email . '</p>';
                }
            }
            ?>
            <form action="#" method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" style="margin-bottom: -15px" />
                <p style="color: red;"><?php echo $emailError; ?></p>

                <button type="submit" class="book-appointment-btn">
                    Reset Password
                </button>
            </form>

            <p class="home-page-title">
                Remember your password?
                <a href="login.php"><strong>Login here</strong></a>
            </p>
        </div>
    </div>
</body>

</html>