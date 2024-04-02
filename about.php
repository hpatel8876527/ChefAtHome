<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .about-container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .about-us h2 {
            color: #333;
            border-bottom: 2px solid rgb(140, 0, 0);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .about-us p {
            line-height: 1.6;
            color: #555;
        }

        .about-us h3 {
            color: rgb(140, 0, 0);
            margin-top: 20px;
            font-size: 1.5rem;
        }

        .about-us ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .about-us li {
            margin-bottom: 8px;
        }

        .about-us img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>

<body>
    <!-- Navbar Section -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <img src="images/logo.png" alt="Logo" />
                <h4>Chef At Home</h4>
            </div>
            <?php include('includes/nav.php'); ?>
            

        </div>
    </header>
    <!-- About Us Section -->
    <div class="about-container">
        <div class="about-us">
            <h2>About Chef At Home</h2>
            <p>
                Welcome to Chef At Home, where culinary excellence meets the comfort
                of your home. Our platform is designed to connect food enthusiasts
                with talented chefs who specialize in various cuisines. Whether you
                crave the bold flavors of Indian spices, the delicate taste of Italian
                pasta, or the sizzling sensations of Mexican cuisine, Chef At Home
                brings the finest chefs to your doorstep.
            </p>

            <h3>Features</h3>
            <p>
                Chef At Home provides a seamless experience with features such as:
            </p>
            <ul>
                <li>
                    <strong>Login and Registration:</strong> Create a personalized
                    account to explore our chefs.
                </li>
                <li>
                    <strong>Password Reset:</strong> Easily reset your password if
                    needed.
                </li>
                <li>
                    <strong>Chef Categories:</strong> Browse chefs based on their
                    expertise in Indian, Chinese, Mexican, Italian, and more.
                </li>
                <li>
                    <strong>Appointment Booking:</strong> Select your favorite chef,
                    book an appointment, and tailor your preferences.
                </li>
                <li>
                    <strong>Secure Payments:</strong> Make hassle-free payments through
                    our secure platform.
                </li>
                <li>
                    <strong>Home Delivery:</strong> Provide your address, and your
                    chosen chef will prepare a delightful dish in the comfort of your
                    home.
                </li>
            </ul>

            <h3>Experience the Best in Home Dining</h3>
            <p>
                Chef At Home is committed to bringing you a culinary experience like
                no other. Our featured chefs, each a maestro in their domain, promise
                to elevate your dining moments. From the sizzling grills to the sweet
                indulgences, our chefs are here to turn your home into a gourmet
                haven.
            </p>

            <img src="images/aboutimge.jpg" alt="Chef At Home Image" />

            <p>
                Join Chef At Home today and embark on a journey of flavors, aromas,
                and culinary wonders. Indulge in the joy of home dining with the
                expertise of world-class chefs. Your exquisite meal is just a click
                away!
            </p>
            <a href="index.php" class="book-appointment-btn" style="width: 100px;">Get Started</a>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h3>Chef At Home</h3>
                    <img src="images/logo.png" alt="Logo" />
                </div>
                <div class="footer-info">
                    <h4>Contact Information</h4>
                    <p>1234 Main Street, City, Country</p>
                    <p>Phone: +1 123-456-7890</p>
                    <p>Email: info@chefathome.com</p>
                </div>

                <div class="footer-links">
                    <ul>
                        <li>
                            <strong><a href="#">Home</a></strong>
                        </li>
                        <li>
                            <strong><a href="#">About Us</a></strong>
                        </li>
                        <li>
                            <strong><a href="#">Chef Directory</a></strong>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="footer-bottom">
                <div class="footer-bottom-center">
                    <p>&copy; 2023 Chef At Home. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>