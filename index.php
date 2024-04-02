<?php 

session_start();

require('classes/db_connection.php');
require('classes/chef.php');
require('classes/message.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$chef_obj = new Chef($db);

$chefs = $chef_obj->get_all_chef_data();

// 3 chefs
$chefs = array_slice($chefs, 0, 3);


// contact form 

$fullNameError = $emailError = $messageError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["full_name"])) {
        $firstNameError = "Full Name is required.";
    }


    if (empty($_POST["email"])) {
        $emailError = "Email is required.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
    }

    if (empty($_POST["message"])) {
        $messageError = "Message is required.";
    } elseif (str_word_count($_POST["message"]) > 200) {
        $messageError = "Message should not exceed 200 words.";
    }
    

    if (
        $fullNameError == "" 
        && $emailError == "" 
        && $messageError == ""
        
        ) {

        $db_conn = new DbConnection();
        $db = $db_conn->get_db_conn();

        $message_obj = new Message($db);
        $message = $message_obj->create_message($_POST);

        header("Location: index.php?msg=contact#contact");
        exit;
    }
}




?>

<!DOCTYPE html>
<html>

<head>
    <title>Chef At Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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

    <!-- Introduction Section -->
    <section class="intro">

        <h1>Welcome to Chef At Home</h1>

        <p>
            Discover talented chefs offering personalized home-cooked meals based on
            your preferences.
        </p>


        <?php if(!isset($_SESSION['user_data']) && !isset($_SESSION['chef_data'])): ?>


        
        <a href="login.php" class="book-appointment-btn" style="width: 100px;">Login as User</a>
        <a href="chef-login.php" class="book-appointment-btn" style="width: 100px;">Login as Chef</a>

        <?php endif; ?>



    </section>
    <!-- Chef List Section -->
    <section class="chef-list" id="chef-list">
        <h2 class="featured-chef"></h2>
        <div class="chef-list-plans">
            
            <?php 
            
                foreach($chefs as $chef){

                    include('includes/chef-card.php');

                }

            ?>

        </div>
    </section>
    <!-- Testimonials Section -->
    <section class="testimonials">
        <h2 class="home-page-title">What Our Users Say</h2>
        <div class="testimonial">
            <blockquote>
                "The culinary expertise of the chefs on Chef At Home is truly
                outstanding. It's like bringing a professional chef into your own
                kitchen!"
            </blockquote>
            <cite>- John Doe</cite>
        </div>
        <div class="testimonial">
            <blockquote>
                "I love the convenience of booking a chef for a personalized meal.
                Chef At Home has made dining at home a delightful experience!"
            </blockquote>
            <cite>- Jane Smith</cite>
        </div>
    </section>
    <!-- Special Offers Section -->
    <section class="special-offers">
        <h2 class="home-page-title">Exclusive Offers</h2>
        <div class="offer">
            <h3>Refer a Friend and Save 10%</h3>
            <p>
                Share the joy of Chef At Home with a friend! Refer them to our
                service, and both of you will enjoy a 10% discount on your next
                culinary experience.
            </p>
        </div>
    </section>

    <!-- How it works Section -->
    <section class="how-it-works">
        <h2 class="home-page-title">How It Works</h2>
        <div class="step">
            <h3>Step 1: Explore Chef Profiles</h3>
            <p>
                Browse through our diverse list of chefs categorized by their
                expertise in Indian, Chinese, Mexican, Italian, and other cuisines.
            </p>
        </div>
        <div class="step">
            <h3>Step 2: Select Your Preferred Chef</h3>
            <p>
                Choose a chef whose profile aligns with your culinary preferences and
                taste.
            </p>
        </div>
        <div class="step">
            <h3>Step 3: Book an Appointment</h3>
            <p>
                Book an appointment with your selected chef at a time that suits you.
            </p>
        </div>
        <div class="step">
            <h3>Step 4: Make Secure Payments</h3>
            <p>
                Make secure online payments to confirm your booking and culinary
                experience.
            </p>
        </div>
        <div class="step">
            <h3>Step 5: Provide Delivery Details</h3>
            <p>
                Provide your address details for the chosen chef to prepare and
                deliver a delightful dish to your doorstep.
            </p>
        </div>
    </section>
    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <h2 class="comming-soon"></h2>
        <div class="pricing-plans">
            <div class="plan">
                <h3>Signature Delights</h3>
                <p class="price">$29.99</p>
                <ul>
                    <li>Access to 5 chef-prepared meals per week</li>
                    <li>Free delivery</li>
                    <li>Customizable menu</li>
                    <li>Weekly culinary inspirations</li>
                </ul>
                <a href="#" class="book-appointment-btn">START TASTING</a>
            </div>
            <div class="plan">
                <h3>Healthy Habits</h3>
                <p class="price">$49.99</p>
                <ul>
                    <li>Enjoy 7 wholesome meals per week</li>
                    <li>Free delivery</li>
                    <li>Customizable menu</li>
                    <li>Nutrition consultation included</li>
                    <li>Weekly personalized recipes</li>
                </ul>
                <a href="#" class="book-appointment-btn">BEGIN YOUR JOURNEY</a>
            </div>
            <div class="plan">
                <h3>Premium Plus</h3>
                <p class="price">$89.99</p>
                <ul>
                    <li>Indulge in 10 exquisite meals per week</li>
                    <li>Free delivery</li>
                    <li>Customizable menu</li>
                    <li>Nutrition consultation</li>
                    <li>24/7 personal chef support</li>
                    <li>Weekly culinary adventures</li>
                </ul>
                <a href="#" class="book-appointment-btn">EXPERIENCE LUXURY</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="contact-card">

                    <?php

                   // contact success message
            if(isset($_GET["msg"]) && $_GET["msg"] == "contact") {
                echo '<p style="color:green;"><strong>Message Sent, Thakyou.</strong><p>';
            }

            ?>

            <h2 class="home-page-title"> CONTACT US</h2>
            <div class="contact-info">
                <p>1234 Main Street, City, Country</p>
                <p>+1 234 5678</p>
                <p>info@chefathome.com</p>
            </div>
            <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" placeholder="Your Full Name" name="full_name" required />

                <p>
                    <?php echo $fullNameError; ?>
                </p>


                <input type="email" placeholder="Your Email Address" name="email" maxlength="150" required />

                <p>
                    <?php echo $emailError; ?>
                </p>

                <textarea placeholder="Message" name="message" required></textarea>

                <p>
                    <?php echo $messageError; ?>
                </p>

                <button class="book-appointment-btn" type="submit">
                    SEND MESSAGE
                </button>
            </form>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="social-media">
        <h2 class="social-media-tital">Connect with Us</h2>
        <div class="social-icons">
            <a href="https://www.facebook.com/" class="fa fa-facebook" id="facebook"></a>
            <a href="https://twitter.com/" class="fa fa-twitter" id="twitter"></a>
            <a href="https://www.linkedin.com/" class="fa fa-linkedin" id="linkedin"></a>
        </div>
    </section>

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