<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT * FROM orders
 WHERE user_id='$user_id'
 ORDER BY order_date DESC");

include '../includes/header.php';
?>

<div class="container mt-5">

    <h2>My Orders</h2>

    <table class="table table-bordered">

        <tr>
            <th>Order ID</th>
            <th>Total Amount</th>
            <th>Order Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td>₹<?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td>
                <a href="order_details.php?id=<?php echo $row['id']; ?>"class="btn btn-sm btn-dark ms-2">View Details</a>  
            </td>
        </tr>
        
        <?php } ?>

    </table>
<a href="../index.php" class="btn btn-secondary mb-3">
    ← Back to Home
</a>
</div>

<?php include '../includes/footer.php'; ?>