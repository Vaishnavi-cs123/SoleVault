<?php
session_start();
include 'includes/db.php';

$message = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();
        }
        else
        {
            $message = "Invalid Password!";
        }
    }
    else
    {
        $message = "User not found!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container mt-5" style="max-width:600px;">

    <div class="card shadow">
        <div class="card-body">

            <h2 class="text-center mb-4">Login</h2>

            <?php if($message != "") { ?>
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST">

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
                        name="login"
                        class="btn btn-dark w-100">
                    Login
                </button>

            </form>

        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>