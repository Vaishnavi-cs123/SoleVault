<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Add product */
if(isset($_GET['add']))
{
    $product_id = $_GET['add'];

    $check = mysqli_query($conn,
    "SELECT * FROM wishlist
     WHERE user_id='$user_id'
     AND product_id='$product_id'");

    if(mysqli_num_rows($check) == 0)
    {
        mysqli_query($conn,
        "INSERT INTO wishlist(user_id,product_id)
         VALUES('$user_id','$product_id')");
    }

    header("Location: wishlist.php");
    exit();
}

/* Remove product */
if(isset($_GET['remove']))
{
    $wishlist_id = $_GET['remove'];

    mysqli_query($conn,
    "DELETE FROM wishlist
     WHERE id='$wishlist_id'
     AND user_id='$user_id'");

    header("Location: wishlist.php");
    exit();
}

$result = mysqli_query($conn,
"SELECT wishlist.id as wishlist_id,
        products.*
 FROM wishlist
 JOIN products
 ON wishlist.product_id = products.id
 WHERE wishlist.user_id='$user_id'");

include 'includes/header.php';
?>

<div class="container mt-5">

    <h2>My Wishlist ❤️</h2>

    <div class="row">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow">

                <img src="uploads/<?php echo $row['image']; ?>"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">

                <div class="card-body">

                    <h5><?php echo $row['name']; ?></h5>

                    <h5>₹<?php echo $row['price']; ?></h5>

                    <a href="product.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-dark">
                        View Product
                    </a>

                    <a href="wishlist.php?remove=<?php echo $row['wishlist_id']; ?>"
                       class="btn btn-danger">
                        Remove
                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>
<a href="shop.php" class="btn btn-secondary mb-3">
    ← Continue Shopping
</a>
</div>

<?php include 'includes/footer.php'; ?>