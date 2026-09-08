<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

$product = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT * FROM products WHERE id='$id'")
);

if(!$product)
{
    header("Location: products.php");
    exit();
}

if(isset($_POST['update_product']))
{
$name = mysqli_real_escape_string($conn, $_POST['name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$stock = mysqli_real_escape_string($conn, $_POST['stock']);

    /* Keep old image by default */
    $image = $product['image'];

    /* If new image uploaded */
    if($_FILES['image']['name'] != "")
    {
        $image = $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/".$image
        );
    }

    $image = mysqli_real_escape_string($conn, $image);

mysqli_query($conn,
"UPDATE products
 SET name='$name',
     description='$description',
     price='$price',
     category='$category',
     stock='$stock',
     image='$image'
 WHERE id='$id'");

    echo "<script>
            alert('Product Updated Successfully');
            window.location='products.php';
          </script>";
}

include '../includes/header.php';
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Edit Product</h2>

        <a href="products.php"
           class="btn btn-secondary">
           ← Back to Products
        </a>
    </div>

    <div class="card shadow p-4">

        <form method="POST"
              enctype="multipart/form-data">

            <div class="mb-3">
                <label>Product Name</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="<?php echo $product['name']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description"
                          class="form-control"
                          rows="5"
                          required><?php echo $product['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       class="form-control"
                       value="<?php echo $product['price']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Category</label>
                <input type="text"
                       name="category"
                       class="form-control"
                       value="<?php echo $product['category']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Stock</label>
                <input type="number"
                       name="stock"
                       class="form-control"
                       value="<?php echo $product['stock']; ?>"
                       required>
            </div>

            <div class="mb-3">

                <label>Current Image</label><br>

                <img src="../uploads/<?php echo $product['image']; ?>"
                     width="150"
                     class="mb-3">

                <input type="file"
                       name="image"
                       class="form-control">
            </div>

            <button class="btn btn-primary"
                    name="update_product">
                Update Product
            </button>

        </form>

    </div>

</div>

<?php include '../includes/footer.php'; ?>