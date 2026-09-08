<?php
include 'includes/db.php';
include 'includes/header.php';

$search = "";

if(isset($_GET['query']))
{
    $search = $_GET['query'];

    $result = mysqli_query($conn,
    "SELECT * FROM products
     WHERE name LIKE '%$search%'
     OR category LIKE '%$search%'");
}
else
{
    $result = mysqli_query($conn,
    "SELECT * FROM products");
}
?>

<div class="container mt-5">

    <h2 class="text-center mb-4">
    Search Results
</h2>

<div class="row justify-content-center mb-5">

    <div class="col-md-8">

        <form method="GET">

            <div class="input-group shadow">

                <input type="text"
                       name="query"
                       class="form-control rounded-start-pill border-0 p-3"
                       placeholder="Search shoes..."
                       value="<?php echo $search; ?>">

                <button class="btn btn-dark rounded-end-pill px-4">
                    🔍 Search
                </button>

            </div>

        </form>

    </div>

</div>

<?php if(!empty($search)) { ?>

<div class="alert alert-info mt-3">
    Showing results for:
    <strong><?php echo $search; ?></strong>
</div>

<?php } ?>

    <form method="GET" class="mb-4">

        <div class="input-group">

            <input type="text"
                   name="query"
                   class="form-control"
                   placeholder="Search shoes..."
                   value="<?php echo $search; ?>">

            <button class="btn btn-dark">
                Search
            </button>

        </div>

    </form>

    <div class="row">

        <?php

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
        ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow">

                <img src="uploads/<?php echo $row['image']; ?>"
                     class="card-img-top"
                     style="height:250px; object-fit:cover;">

                <div class="card-body">

                    <h5><?php echo $row['name']; ?></h5>

                    <p>
                        <?php echo substr($row['description'],0,80); ?>...
                    </p>

                    <h5>₹<?php echo $row['price']; ?></h5>

                    <a href="product.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-dark">
                        View Details
                    </a>

                </div>

            </div>

        </div>

        <?php
            }
        }
        else
        {
            echo "<div class='alert alert-warning'>No products found.</div>";
        }
        ?>

    </div>

</div>

<?php include 'includes/footer.php'; ?>