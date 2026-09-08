# SoleVault 

SoleVault is a simple e-commerce website for selling shoes that I developed
using PHP and MySQL.

I created this project mainly to practice Web Application Penetration Testing
(WAPT). Instead of making it a completely secure application, I intentionally
included different vulnerabilities so that I could test and understand them
in a local environment.

This is a beginner-friendly WAPT lab, mainly focused on understanding basic
web application vulnerabilities and how they can be tested.

## About the Project

The website has both customer and admin functionality.

### Customer Side

- Register and login
- View and search products
- Browse products by category and brand
- Add products to wishlist
- Add products to cart
- Checkout
- View orders
- View and update profile
- Change password
- Contact form

### Admin Side

- Admin login
- Admin dashboard
- Add products
- Edit products
- Delete products
- Manage users
- Manage orders

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- XAMPP

## Security Testing

While developing and testing SoleVault, I worked with different web
application vulnerabilities, including:

- SQL Injection
- Cross-Site Scripting (XSS)
- IDOR / Broken Access Control
- Cross-Site Request Forgery (CSRF)
- File Upload Vulnerability
- Price Tampering
- Business Logic Vulnerabilities
- Clickjacking
- Missing Security Headers

I used Burp Suite and manual testing to understand how these vulnerabilities
work and how they can be identified during a penetration test.

The current version of SoleVault is a basic security lab and mainly contains
beginner-level vulnerabilities. I am still working on the project and plan
to add more advanced vulnerabilities and testing scenarios in the future.

Setup

To run the project locally:

1.Install XAMPP.
2.Start Apache and MySQL.
3.Put the solevault folder inside:
 C:\xampp\htdocs\
4.Create a MySQL database named:
 solevault
5.Import the database file into MySQL.
6.Configure your local database connection in includes/db.php.
7.Open the following in your browser:
  http://localhost/solevault/
