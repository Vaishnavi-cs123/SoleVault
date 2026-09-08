<?php
include 'includes/db.php';

$brand = isset($_GET['brand']) ? $_GET['brand'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$sql = "SELECT * FROM products WHERE 1=1";

if($brand != "")
{
    $sql .= " AND brand='".mysqli_real_escape_string($conn,$brand)."'";
}

if($category != "")
{
    $sql .= " AND category='".mysqli_real_escape_string($conn,$category)."'";
}

$result = mysqli_query($conn,$sql);

$brands = mysqli_query($conn,
"SELECT DISTINCT brand FROM products ORDER BY brand");

$categories = mysqli_query($conn,
"SELECT DISTINCT category FROM products ORDER BY category");


include 'includes/header.php';
?>

<style>

body{
    background:#f5f5f5;
}

.sidebar-card{
    background:white;
    border-radius:12px;
    padding:20px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.product-card{

    border:none;
    border-radius:15px;
    overflow:hidden;

    transition:.3s;
}

.product-card:hover{

    transform:translateY(-6px);

    box-shadow:0 10px 25px rgba(0,0,0,.15);

}

.product-card img{

    height:230px;

    object-fit:cover;

}

.badge-featured{

    position:absolute;

    top:15px;

    left:15px;

    z-index:100;

}

.stock{

    font-size:14px;

}

</style>


<div class="container mt-4">

<div class="row mb-4">

<div class="col-md-12">

<form action="search.php" method="GET">

<div class="input-group shadow">

<input
type="text"
name="query"
class="form-control form-control-lg"
placeholder="Search Shoes, Brands, Categories..."
required>

<button class="btn btn-dark">

 Search

</button>

</div>

</form>

</div>

</div>


<div class="row">

<!-- LEFT SIDEBAR -->

<div class="col-lg-3">

<div class="sidebar-card">

<form method="GET">

<h5>Brands</h5>

<hr>

<?php while($b=mysqli_fetch_assoc($brands)){ ?>

<div class="form-check mb-2">

<input
class="form-check-input"
type="radio"
name="brand"
value="<?php echo $b['brand'];?>"

<?php
if($brand==$b['brand'])
echo "checked";
?>

>

<label class="form-check-label">

<?php echo $b['brand'];?>

</label>

</div>

<?php } ?>

<hr>

<h5>Categories</h5>

<hr>

<?php while($c=mysqli_fetch_assoc($categories)){ ?>

<div class="form-check mb-2">

<input
class="form-check-input"
type="radio"
name="category"
value="<?php echo $c['category'];?>"

<?php
if($category==$c['category'])
echo "checked";
?>

>

<label class="form-check-label">

<?php echo $c['category'];?>

</label>

</div>

<?php } ?>

<button
class="btn btn-dark w-100 mt-3">

Apply Filters

</button>

<a
href="shop.php"
class="btn btn-outline-secondary w-100 mt-2">

Clear Filters

</a>

</form>

</div>

</div>

<!-- PRODUCTS -->

<div class="col-lg-9">

<div class="d-flex justify-content-between align-items-center mb-4">

<h3>

Shop Collection

<small class="text-muted">

(<?php echo mysqli_num_rows($result); ?> Products)

</small>

</h3>

<select class="form-select w-auto">

<option>Newest</option>

<option>Price : Low → High</option>

<option>Price : High → Low</option>

<option>Name : A-Z</option>

</select>

</div>

<div class="row">

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<div class="col-md-6 col-lg-4 mb-4">

<div class="card product-card h-100 position-relative">

<?php if($row['featured']==1){ ?>

<span class="badge bg-danger badge-featured">

FEATURED

</span>

<?php } ?>

<img
src="uploads/<?php echo $row['image'];?>"
class="card-img-top">

<div class="card-body">

<h5>

<?php echo $row['name'];?>

</h5>

<?php

$rating_result = mysqli_query($conn,
"SELECT
AVG(rating) AS avg_rating,
COUNT(*) AS total_reviews
FROM reviews
WHERE product_id='".$row['id']."'");

$rating = mysqli_fetch_assoc($rating_result);

$avg = round($rating['avg_rating']);

$total = $rating['total_reviews'];

?>

<div class="mb-2">

<?php

if($total>0)
{

echo "<span class='text-warning'>";

for($i=1;$i<=5;$i++)
{

if($i<=$avg)
echo "★";
else
echo "☆";

}

echo "</span>";

echo " <small class='text-muted'>($total Reviews)</small>";

}
else
{

echo "<small class='text-muted'>No Reviews Yet</small>";

}

?>

</div>

<div class="mb-2">

<span class="badge bg-primary">

<?php echo $row['brand']; ?>

</span>

<span class="badge bg-secondary">

<?php echo $row['category']; ?>

</span>

</div>

<p>

<strong>Available Sizes</strong>

<br>

<?php

$sizes = explode(",",$row['sizes']);

foreach($sizes as $size)
{

echo "<span class='badge bg-light text-dark border me-1'>$size</span>";

}

?>

</p>

<?php

if($row['stock']>0)
{

echo "<span class='badge bg-success stock'>In Stock</span>";

}
else{

echo "<span class='badge bg-secondary stock'>Out Of Stock</span>";

}

?>

<h4 class="text-success mt-3">

₹<?php echo number_format($row['price']); ?>

</h4>

<a
href="product.php?id=<?php echo $row['id'];?>"
class="btn btn-dark w-100 mt-2">

View Product →

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>