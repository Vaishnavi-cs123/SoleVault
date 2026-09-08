<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

include '../includes/header.php';
?>

<div class="container mt-5">

    <h2>Admin Dashboard</h2>
    <hr>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h4>Products</h4>
                    <a href="products.php" class="btn btn-dark">
                        Manage Products
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h4>Users</h4>
                    <a href="users.php" class="btn btn-dark">
                        View Users
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h4>Orders</h4>
                    <a href="orders.php" class="btn btn-dark">
                        View Orders
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>