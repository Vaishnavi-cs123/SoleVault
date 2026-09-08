<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT * FROM users WHERE id='$user_id'")
);

$message = "";
$messageType = "success";

/* Profile Picture Upload */
if(isset($_POST['upload_profile']))
{
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0)
    {
        $fileName = $_FILES['profile_image']['name'];
        $tmpName = $_FILES['profile_image']['tmp_name'];

        $uploadPath = "../uploads/profile/" . $fileName;

        move_uploaded_file($tmpName, $uploadPath);

        mysqli_query($conn,
        "UPDATE users
         SET profile_image='$fileName'
         WHERE id='$user_id'");

        $message = "Profile picture uploaded successfully.";
        $messageType = "success";

        $user = mysqli_fetch_assoc(
            mysqli_query($conn,
            "SELECT * FROM users WHERE id='$user_id'")
        );
    }
    else
    {
        $message = "Please select a file.";
        $messageType = "danger";
    }
}

/* Change Password */
if(isset($_POST['change_password']))
{
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if(!password_verify($current_password, $user['password']))
    {
        $message = "Current password is incorrect.";
        $messageType = "danger";
    }
    elseif(strlen($new_password) < 8)
    {
        $message = "New password must be at least 8 characters.";
        $messageType = "danger";
    }
    elseif($new_password != $confirm_password)
    {
        $message = "New Password and Confirm Password do not match.";
        $messageType = "danger";
    }
    else
    {
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

        mysqli_query($conn,
        "UPDATE users
         SET password='$hashedPassword'
         WHERE id='$user_id'");

        $message = "Password changed successfully.";

        $user = mysqli_fetch_assoc(
            mysqli_query($conn,
            "SELECT * FROM users WHERE id='$user_id'")
        );
    }
}

include '../includes/header.php';
?>

<div class="container mt-5" style="max-width:700px;">

    <div class="card shadow">

        <div class="card-body">

            <h2 class="text-center mb-4">My Profile</h2>

            <?php if($message != "") { ?>

                <div class="alert alert-<?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div>

            <?php } ?>

<!-- Profile Information -->

<h4>Profile Information</h4>

<hr>

<div class="row align-items-center">

    <!-- User Information -->
    <div class="col-md-8">

        <table class="table table-borderless mb-0">

            <tr>
                <th width="180">Full Name</th>
                <td><?php echo htmlspecialchars($user['fullname']); ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>

            <tr>
                <th>Role</th>
                <td><?php echo ucfirst(htmlspecialchars($user['role'])); ?></td>
            </tr>

        </table>

    </div>


    <!-- Profile Image -->
    <div class="col-md-4 text-center">

        <?php if(!empty($user['profile_image'])) { ?>

            <img
                src="../uploads/profile/<?php echo htmlspecialchars($user['profile_image']); ?>"
                style="
                    width:120px;
                    height:120px;
                    border-radius:50%;
                    object-fit:cover;
                    border:3px solid #ddd;
                "
                alt="Profile Image">

        <?php } else { ?>

            <div
                style="
                    width:120px;
                    height:120px;
                    border-radius:50%;
                    background:#eee;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    margin:auto;
                    font-size:40px;
                    color:#777;
                ">
                👤
            </div>

        <?php } ?>

    </div>

</div>

            <hr class="my-5">

<h4>Upload Profile Picture</h4>

<hr>

<form method="POST" enctype="multipart/form-data">

    <div class="mb-3">

        <input
            type="file"
            name="profile_image"
            class="form-control"
            required>

    </div>

    <button
        type="submit"
        name="upload_profile"
        class="btn btn-dark">

        Upload Profile Picture

    </button>

</form>

            <h4>Change Password</h4>

            <hr>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Current Password
                    </label>

                    <input
                        type="password"
                        name="current_password"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="new_password"
                        class="form-control"
                        required>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="confirm_password"
                        class="form-control"
                        required>

                </div>

                <button
                    type="submit"
                    name="change_password"
                    class="btn btn-dark">

                    Change Password

                </button>

            </form>

        </div>

    </div>

    <a href="../shop.php" class="btn btn-secondary mt-4">
        ← Continue Shopping
    </a>

</div>

<?php include '../includes/footer.php'; ?>