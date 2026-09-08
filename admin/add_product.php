<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

$message = "";

if(isset($_POST['add_product']))
{
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $price = $_POST['price'];
   $stock = $_POST['stock'];
   $category = mysqli_real_escape_string($conn, $_POST['category']);

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/".$image);

    $sql = "INSERT INTO products
            (name, description, price, image, stock, category)
            VALUES
            ('$name','$description','$price','$image','$stock','$category')";

    if(mysqli_query($conn, $sql))
{
    $message = "Product Added Successfully";
}
else
{
    echo mysqli_error($conn);
}
}
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">

    <h2>Add Product</h2>

    <?php if($message!=""){ ?>
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01"
                   name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Product Image</label>
            <input type="file" name="image"
                   class="form-control" required>
        </div>

        <button type="submit"
                name="add_product"
                class="btn btn-dark">
            Add Product
        </button>

    </form>

</div>

<?php include '../includes/footer.php'; ?>