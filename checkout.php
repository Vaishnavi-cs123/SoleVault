<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$cart_items = mysqli_query($conn,
"SELECT cart.*, products.price
 FROM cart
 JOIN products
 ON cart.product_id = products.id
 WHERE cart.user_id='$user_id'");

$total = 0;

while($item = mysqli_fetch_assoc($cart_items))
{
    $total += ($item['price'] * $item['quantity']);
}

if(isset($_POST['place_order']))
{
    if($total <= 0)
    {
        echo "<script>alert('Your cart is empty!');</script>";
    }
    else
    {
        mysqli_query($conn,
        "INSERT INTO orders(user_id,total_amount)
         VALUES('$user_id','$total')");

        $order_id = mysqli_insert_id($conn);

        $items = mysqli_query($conn,
        "SELECT cart.*, products.price
         FROM cart
         JOIN products
         ON cart.product_id = products.id
         WHERE cart.user_id='$user_id'");

        while($item = mysqli_fetch_assoc($items))
        {
            mysqli_query($conn,
            "INSERT INTO order_items(order_id,product_id,quantity,price)
             VALUES('$order_id',
                    '".$item['product_id']."',
                    '".$item['quantity']."',
                    '".$item['price']."')");
        }

        mysqli_query($conn,
        "DELETE FROM cart WHERE user_id='$user_id'");

        echo "<script>
                alert('Order Placed Successfully');
                window.location='customer/orders.php';
              </script>";
    }
}

include 'includes/header.php';
?>

<div class="container mt-5">

    <h2>Checkout</h2>

    <h3>Total Amount: ₹<?php echo $total; ?></h3>

    <form method="POST">

        <?php if($total > 0){ ?>

            <button class="btn btn-success"
                    name="place_order">
                Place Order
            </button>

        <?php } else { ?>

            <div class="alert alert-warning">
                Your cart is empty.
            </div>

        <?php } ?>

    </form>

</div>

<?php include 'includes/footer.php'; ?>