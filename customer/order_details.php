<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(!isset($_GET['id']))
{
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM orders
 WHERE id='$order_id'");

$order = mysqli_fetch_assoc($result);

include '../includes/header.php';
?>

<div class="container mt-5">

    <h2>Order Details</h2>
    
    <?php if($order) { ?>

        <div class="card shadow">

            <div class="card-body">

                <h5>Order #<?php echo $order['id']; ?></h5>

                <p>
                    <strong>User ID:</strong>
                    <?php echo $order['user_id']; ?>
                </p>

                <p>
                    <strong>Total Amount:</strong>
                    ₹<?php echo $order['total_amount']; ?>
                </p>

                <p>
                    <strong>Order Date:</strong>
                    <?php echo $order['order_date']; ?>
                </p>

            </div>

        </div>

    <?php } else { ?>

        <div class="alert alert-warning">
            Order not found.
        </div>

    <?php } ?>

    <a href="orders.php" class="btn btn-secondary mt-3">
        ← Back to Orders
    </a>

</div>

<?php include '../includes/footer.php'; ?>