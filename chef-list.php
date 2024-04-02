<?php

session_start();


require('classes/db_connection.php');
require('classes/chef.php');

$db_conn = new DbConnection();
$db = $db_conn->get_db_conn();

$chef_obj = new Chef($db);

$chefs = $chef_obj->get_all_chef_data();


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .cheflist-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            background-color: rgba(168, 149, 149, 0.8);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            /* Adjusted margin for better spacing */
            width: calc(33.33% - 20px);
            /* Calculating width for three cards with margin */
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Added a subtle box shadow */
        }

        .card h3 {
            /* Changed from h2 to h3 for consistency in HTML */
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        .card img {
            max-width: 100%;
            margin-bottom: 10px;
            border-radius: 10px;
            /* Reduced border radius for a softer look */
        }

        .card video {
            max-width: 100%;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Added a subtle box shadow */
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

        <h1 style="text-align: center;">Chefs List</h1>

    </header>


    <!-- Card Section -->
    <div class="cheflist-container" style="margin-top: 5rem;">

        <?php

        foreach($chefs as $chef) {

            include('includes/chef-card.php');

        }

?>

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
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("profileDropdown");
            dropdown.classList.toggle("show-dropdown");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show-dropdown')) {
                        openDropdown.classList.remove('show-dropdown');
                    }
                }
            }
        }
    </script>
</body>

</html>