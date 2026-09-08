<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

/* Delete Product */
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM products WHERE id='$id'");

    header("Location: products.php");
    exit();
}

$result = mysqli_query($conn,
"SELECT * FROM products");

include '../includes/header.php';
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>Manage Products</h2>

        <div>
            <a href="dashboard.php"
               class="btn btn-secondary">
               ← Dashboard
            </a>

            <a href="add_product.php"
               class="btn btn-success">
               + Add Product
            </a>
        </div>

    </div>

    <table class="table table-bordered table-striped align-middle">

        <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th width="180">Actions</th>
            </tr>

        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td>
                <img src="../uploads/<?php echo $row['image']; ?>"
                     width="100">
            </td>

            <td><?php echo $row['name']; ?></td>

            <td>₹<?php echo $row['price']; ?></td>

            <td><?php echo $row['stock']; ?></td>

            <td>

                <a href="edit_product.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-primary btn-sm">
                    Edit
                </a>

                <a href="products.php?delete=<?php echo $row['id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Are you sure you want to delete this product?')">
                    Delete
                </a>

            </td>

        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php include '../includes/footer.php'; ?>