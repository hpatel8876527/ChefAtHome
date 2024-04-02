
-- Users Table

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    address VARCHAR(255)
);



INSERT INTO `users` (`id`, `password`, `email`, `first_name`, `last_name`, `phone_number`, `address`) VALUES
(1, '$2y$10$WL0SyZ.gcxxZtbv9S21OgOkW5Aih634KxsgumuqvMPMfk1TdqBY6q', 'feqa@mailinator.com', 'Wayne', 'Sykes', '', ''),
(2, '$2y$10$K2vvzaBIhkh.nItWCyesZ.5qwTra203DOB/YY01HI0i.r4f5vZOoi', 'majydy@mailinator.com', 'Sophia', 'Oneal', '+1 (416) 989-4155', 'Mollitia deleniti si'),
(3, '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', 'vuvycug@mailinator.com', 'Riley', 'Garner', '+1 (237) 692-8747', 'Rerum nulla non sit'),
(4, '$2y$10$nS63Tb67zqhEql.EPkrW0.25yjG2MNhmWl5FMXoDMujGtgAUKhn.q', 'nuko@mailinator.com', 'Camilla', 'Grahamm', '+1 (889) 462-7507', 'Quam nemo vel illo e');


-- Chefs Table
CREATE TABLE chefs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    img_url VARCHAR(255),
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(100),
    specialization VARCHAR(255),
    price_range VARCHAR(255),
    experience_level VARCHAR(255),
    rating VARCHAR(255),
    availability VARCHAR(50)
);


INSERT INTO chefs (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability)
VALUES ('chef1.jpeg', 'John', 'Doe', 'john.doe@example.com', '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', '+1234567890', 'Mexican Cuisine', '$20 - $35 per dish', 'Master Chef', '⭐⭐⭐⭐⭐ (5/5)', 'Flexible');

INSERT INTO chefs (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability)
VALUES ('chef2.jpeg', 'Jane', 'Smith', 'jane.smith@example.com', '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', '+0987654321', 'Italian Cuisine', '$15 - $25 per dish', 'Executive Chef', '⭐⭐⭐⭐ (4/5)', 'Flexible');

INSERT INTO chefs (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability)
VALUES ('chef3.jpeg', 'Michael', 'Johnson', 'michael.johnson@example.com', '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', '+1122334455', 'French Cuisine', '$25 - $40 per dish', 'Sous Chef', '⭐⭐⭐⭐ (4/5)', 'Flexible');

INSERT INTO chefs (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability)
VALUES ('chef4.jpeg', 'Emily', 'Brown', 'emily.brown@example.com', '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', '+3344556677', 'Japanese Cuisine', '$30 - $50 per dish', 'Head Chef', '⭐⭐⭐⭐⭐ (5/5)', 'Flexible');

INSERT INTO chefs (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability)
VALUES ('chef5.jpeg','David', 'Martinez', 'david.martinez@example.com', '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', '+5566778899', 'Indian Cuisine', '$20 - $35 per dish', 'Chef de Partie', '⭐⭐⭐⭐ (4/5)', 'Flexible');

INSERT INTO chefs (img_url, first_name, last_name, email, password, phone_number, specialization, price_range, experience_level, rating, availability)
VALUES ('chef6.jpeg', 'Sarah', 'Garcia', 'sarah.garcia@example.com', '$2y$10$tK5j.ZYrGaiIsXX8rG2.Nez0CziDXEXhbTUwmc3.Up4VpGcANEYIS', '+9900112233', 'Chinese Cuisine', '$25 - $40 per dish', 'Commis Chef', '⭐⭐⭐⭐ (4/5)', 'Flexible');


-- Admin Table
CREATE TABLE admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


INSERT INTO admins (username, email, password) VALUES ('admin', 'admin@example.com', 'password');


-- Bookings Table

CREATE TABLE bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_number VARCHAR(255) NOT NULL,
    user_id INT,
    chef_id INT,
    date DATE,
    time TIME,
    payment_status ENUM('Pending', 'Paid', 'Cancelled'),
    booking_status ENUM('Pending', 'Confirmed', 'Cancelled'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (chef_id) REFERENCES chefs(id)
);


-- Contact Messages

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    email VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO messages (full_name, email, message) VALUES
('John Doe', 'john@example.com', 'This is a dummy message from John Doe.'),
('Jane Smith', 'jane@example.com', 'Hello, this is a test message from Jane Smith. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
('Michael Johnson', 'michael@example.com', 'Hey there! Just testing out the messaging system. Cheers!');
