<div class="chef">
    <img src="images/<?php echo $chef['img_url']; ?>" alt="Chef John Doe" class="chef-photo" />
    <h3><?php echo $chef['first_name'] . ' ' . $chef['last_name'];  ?></h3>
    <ul class="chef-details">
        <li><strong>Specialization: </strong> <?php echo $chef['specialization']; ?></li>
        <li><strong>Price Range: </strong><?php echo $chef['price_range']; ?></li>
        <li><strong>Availability: </strong> <?php echo $chef['availability']; ?></li>
        <li><strong>Experience Level: </strong> <?php echo $chef['experience_level']; ?></li>
        <li><strong>Rating: </strong> <?php echo $chef['rating']; ?></li>
    </ul>
    <a href="appointment-booking.php?chef_id=<?php echo $chef['id']; ?>" class="book-appointment-btn booking-btn">Book Appointment</a>
</div>