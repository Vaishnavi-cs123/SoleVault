<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

$result = mysqli_query($conn,
"SELECT orders.*, users.fullname
 FROM orders
 JOIN users
 ON orders.user_id = users.id
 ORDER BY order_date DESC");

include '../includes/header.php';
?>

<div class="container mt-5">

    <h2>All Orders</h2>

    <table class="table table-bordered">

        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total Amount</th>
            <th>Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <tr>
            <td>#<?php echo $row['id']; ?></td>
            <td><?php echo $row['fullname']; ?></td>
            <td>₹<?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
        </tr>

        <?php } ?>

    </table>
<a href="dashboard.php" class="btn btn-secondary mb-3">
    ← Back
</a>
</div>

<?php include '../includes/footer.php'; ?>