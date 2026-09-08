<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Add product to cart */
if(isset($_GET['add']))
{
    $product_id = $_GET['add'];

    $check = mysqli_query($conn,
            "SELECT * FROM cart
             WHERE user_id='$user_id'
             AND product_id='$product_id'");

    if(mysqli_num_rows($check) > 0)
    {
        mysqli_query($conn,
        "UPDATE cart
         SET quantity = quantity + 1
         WHERE user_id='$user_id'
         AND product_id='$product_id'");
    }
    else
    {
        mysqli_query($conn,
        "INSERT INTO cart(user_id, product_id, quantity)
         VALUES('$user_id','$product_id',1)");
    }

    header("Location: cart.php");
    exit();
}

/* Remove item */
if(isset($_GET['remove']))
{
    $cart_id = $_GET['remove'];

    mysqli_query($conn,
    "DELETE FROM cart
     WHERE id='$cart_id'
     AND user_id='$user_id'");

    header("Location: cart.php");
    exit();
}

$result = mysqli_query($conn,
"SELECT cart.id as cart_id,
        products.*
 FROM cart
 JOIN products
 ON cart.product_id = products.id
 WHERE cart.user_id='$user_id'");

include 'includes/header.php';
?>

<div class="container mt-5">

    <h2>Your Cart</h2>

    <table class="table table-bordered">

        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php
        $total = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $total += $row['price'];
        ?>

        <tr>

            <td>
                <img src="uploads/<?php echo $row['image']; ?>"
                     width="100">
            </td>

            <td><?php echo $row['name']; ?></td>

            <td>₹<?php echo $row['price']; ?></td>

            <td>
                <a href="cart.php?remove=<?php echo $row['cart_id']; ?>"
                   class="btn btn-danger">
                   Remove
                </a>
            </td>

        </tr>

        <?php } ?>

    </table>

    <h3>Total: ₹<?php echo $total; ?></h3>

    <a href="checkout.php"
       class="btn btn-success">
       Proceed to Checkout
    </a>

</div>

<?php include 'includes/footer.php'; ?>