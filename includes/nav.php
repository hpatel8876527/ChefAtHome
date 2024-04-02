<ul class="nav-links">
                <li>
                    <strong><a href="index.php">Home</a></strong>
                </li>

                
                <li>
                    <strong><a href="about.php">About Us</a></strong>
                </li>

                <li>
                    <strong><a href="chef-list.php">Chefs List</a></strong>
                </li>

                
                
                <?php // Is Logged In ?>

                <?php if(isset($_SESSION['user_data']) || isset($_SESSION['chef_data']) ): ?>


                    <!-- User Logged In -->
                    <?php if(isset($_SESSION['user_data'])): ?>

                        
                        <li>
                            <strong>
                                <a href="user-profile.php">
                                    (User - <?php echo $_SESSION['user_data']['first_name'] . ' ' .  $_SESSION['user_data']['last_name']; ?>)
                                </a>
                            </strong>
                        </li>
                        
                        <li>
                            <strong><a href="user-my-bookings.php">My Bookings</a></strong>
                        </li>

                    <?php endif; ?>



                       <!-- Chef Logged In -->
                        <?php if(isset($_SESSION['chef_data'])): ?>


                            <li>
                                <strong>
                                    <a href="chef-profile.php">
                                        (Chef - <?php echo $_SESSION['chef_data']['first_name'] . ' ' .  $_SESSION['chef_data']['last_name']; ?>)
                                    </a>
                                </strong>
                            </li>

                            <li>
                                <strong><a href="chef-my-bookings.php">My Bookings</a></strong>
                            </li>

                        <?php endif; ?>


                    

                    <li>
                        <strong><a href="logout.php?logout_user=1">Logout</a></strong>
                    </li>


                <?php else: ?>
                        
                    <li>
                        <strong>
                            <a href="login.php">Login</a> 
                            <span>/</span>
                            <a href="register.php">Regsiter</a>
                        </strong>
                        
                    </li>

                <?php endif; ?>


            </ul>