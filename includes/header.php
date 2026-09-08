<?php
if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoleVault</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero{
            background:#f8f9fa;
            padding:80px 20px;
            text-align:center;
        }

        .product-card img{
            height:250px;
            object-fit:cover;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/solevault/index.php">
            SoleVault
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <!-- Home visible to everyone -->
                <li class="nav-item">
                    <a class="nav-link" href="/solevault/index.php">
                        Home
                    </a>
                </li>

                <?php if(isset($_SESSION['user_id'])) { ?>

                 <!--   <li class="nav-item">
                        <a class="nav-link" href="#">
                            Welcome, <?php echo $_SESSION['fullname']; ?>  
                        </a>
                    </li> --> 

                    <!-- CUSTOMER NAVBAR -->
                    <?php if($_SESSION['role'] == 'customer'){ ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/solevault/shop.php">
                                Shop
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/solevault/cart.php">
                                Cart
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/solevault/wishlist.php">
                                Wishlist
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/solevault/customer/orders.php">
                                My Orders
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/solevault/customer/profile.php">
                                Profile
                            </a>
                        </li>

                    <?php } ?>

                    <!-- ADMIN NAVBAR -->
                    <?php if($_SESSION['role'] == 'admin'){ ?>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/solevault/admin/dashboard.php">
                                Admin Panel
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"
                               href="/solevault/customer/profile.php">
                                Profile
                            </a>
                        </li>

                    <?php } ?>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="/solevault/logout.php">
                            Logout
                        </a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/solevault/shop.php">
                            Shop
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="/solevault/login.php">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="/solevault/register.php">
                            Register
                        </a>
                    </li>

                <?php } ?>

            </ul>

        </div>
    </div>
</nav>