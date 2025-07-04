# 🛒 E-Commerce Website (PHP + XAMPP)

This is a simple e-commerce website built using **PHP**, **MySQL**, **HTML/CSS**, and **JavaScript**. It uses XAMPP for local server environment and is meant for educational/demo purposes.

🚀 Features

- User registration and login system
- Product catalog
- Add to cart & checkout functionality
- Admin dashboard to manage products
- Order history

 🛠️ Requirements

- [XAMPP](https://www.apachefriends.org/) installed on your system
- Web browser
- Code editor (VS Code recommended)

folder structure

/Mobile-Shopee
│

├── account.php # User account options

├── address.php # Delivery address management

├── cart.php # Cart logic

├── feedback.php # User feedback page

├── functions.php # Utility functions

├── header.php # Header include

├── index.php # Home page

├── login.php # Login page

├── logout.php # Logout logic

├── orders.php # Order summary page

├── config/ # (Optional) config files like db

├── assets/ # Images, CSS, JS, fonts

├── database/

│ └── shopee.sql # SQL dump to create the database

├── Template/ # Reusable template components

│ ├── _products.php

│ ├── _new-phones.php

│ ├── _cart-template.php

│ └── etc...
└── JS/

└── index.js # JavaScript for interactions

Features
🔐 User login/logout
🛒 Add to cart and checkout
📦 Product pages and filters
🧾 Orders & Address management
💳 Payment options display
⭐ Feedback and rating


🖥️ How to Run the Project Locally

Follow these steps to set up and run the project on your local machine:


```bash
1. Clone the Repository
git clone https://github.com/your-username/ecommerce-site.git

2.Move the Project to XAMPP Directory

Copy or move the folder to your htdocs directory:
C:\xampp\htdocs\tutorial\MOBILE SHOPEE

3. Start XAMPP
Start Apache and MySQL from XAMPP Control Panel.

4. Import the Database
Open http://localhost/phpmyadmin
Create a new database: shopee
Click Import and upload shopee.sql from the /database folder.
Click Go to import the tables.

5. Run the Website
Visit in browser:

http://localhost/mobile-shopee

