<?php
session_start();
include 'includes/db.php';

if(!isset($_GET['id']))
{
    header("Location: shop.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'");

$product = mysqli_fetch_assoc($result);

/* Submit Review */
if(isset($_POST['submit_review']))
{
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id'];
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];

        mysqli_query($conn,
        "INSERT INTO reviews(product_id,user_id,rating,comment)
         VALUES('$id','$user_id','$rating','$comment')");

        header("Location: product.php?id=$id");
        exit();
    }
    else
    {
        echo "<script>alert('Please login first');</script>";
    }
}

/* Fetch Reviews */
$reviews = mysqli_query($conn,
"SELECT reviews.*, users.fullname
 FROM reviews
 JOIN users
 ON reviews.user_id = users.id
 WHERE product_id='$id'
 ORDER BY created_at DESC");

include 'includes/header.php';
?>

<div class="container mt-5">

    <div class="row">

        <div class="col-md-6">
            <img src="uploads/<?php echo $product['image']; ?>"
                 class="img-fluid rounded">
        </div>

        <div class="col-md-6">

            <h2><?php echo $product['name']; ?></h2>

            <h3 class="text-success">
                ₹<?php echo $product['price']; ?>
            </h3>

            <p><?php echo $product['description']; ?></p>

            <p>
                <strong>Category:</strong>
                <?php echo $product['category']; ?>
            </p>

            <p>
                <strong>Stock:</strong>
                <?php echo $product['stock']; ?>
            </p>

           <a href="cart.php?add=<?php echo $product['id']; ?>"
   class="btn btn-dark">
    Add to Cart
</a>

<?php if(isset($_SESSION['user_id'])) { ?>

<a href="wishlist.php?add=<?php echo $product['id']; ?>"
   class="btn btn-danger ms-2">
   ❤️ Add to Wishlist
</a>

<?php } ?>

        </div>

    </div>

    <hr class="mt-5">

    <h3>Customer Reviews</h3>

    <?php if(isset($_SESSION['user_id'])) { ?>

        <form method="POST" class="mb-4">

            <div class="mb-3">
                <label>Rating</label>
                <select name="rating" class="form-control">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Comment</label>
                <textarea name="comment"
                          class="form-control"
                          required></textarea>
            </div>

            <button class="btn btn-dark"
                    name="submit_review">
                Submit Review
            </button>

        </form>

    <?php } else { ?>

        <div class="alert alert-info">
            Login to write a review.
        </div>

    <?php } ?>

    <?php while($review = mysqli_fetch_assoc($reviews)) { ?>

        <div class="card mb-3">

            <div class="card-body">

                <h5>
                    <?php echo $review['fullname']; ?>
                    - ⭐ <?php echo $review['rating']; ?>/5
                </h5>

                <p><?php echo $review['comment']; ?></p>

                <small class="text-muted">
                    <?php echo $review['created_at']; ?>
                </small>

            </div>

        </div>

    <?php } ?>

</div>

<?php include 'includes/footer.php'; ?>