<?php
include 'includes/db.php';

$message = "";

if(isset($_POST['register']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hashing password (we can intentionally weaken this later)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(fullname, email, password)
            VALUES('$fullname', '$email', '$hashedPassword')";

    if(mysqli_query($conn, $sql))
    {
        $message = "Registration Successful!";
    }
    else
    {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>



<?php include 'includes/header.php'; ?>

<div class="container mt-5" style="max-width:600px;">

    <div class="card shadow">
        <div class="card-body">

            <h2 class="text-center mb-4">Create Account</h2>

            <?php if($message != "") { ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text"
                           name="fullname"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <button type="submit"
                        name="register"
                        class="btn btn-dark w-100">
                    Register
                </button>

            </form>

        </div>
    </div>

</div>



<?php include 'includes/footer.php'; ?>

