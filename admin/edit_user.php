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
    header("Location: users.php");
    exit();
}

$id = $_GET['id'];

$user = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT * FROM users WHERE id='$id'")
);

if(!$user)
{
    header("Location: users.php");
    exit();
}

if(isset($_POST['update_user']))
{
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Prevent admin from changing their own role
    if($id == $_SESSION['user_id'])
    {
        $role = $user['role'];
    }
    else
    {
        $role = mysqli_real_escape_string($conn, $_POST['role']);
    }

    mysqli_query($conn,
    "UPDATE users
     SET fullname='$fullname',
         email='$email',
         role='$role'
     WHERE id='$id'");

    echo "<script>
            alert('User Updated Successfully');
            window.location='users.php';
          </script>";
}

include '../includes/header.php';
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>Edit User</h2>

        <a href="users.php"
           class="btn btn-secondary">
            ← Back to Users
        </a>

    </div>

    <div class="card shadow p-4">

        <form method="POST">

            <div class="mb-3">
                <label>Full Name</label>
                <input type="text"
                       name="fullname"
                       class="form-control"
                       value="<?php echo htmlspecialchars($user['fullname']); ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="<?php echo htmlspecialchars($user['email']); ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Role</label>

                <?php if($id == $_SESSION['user_id']) { ?>

                    <input type="text"
                           class="form-control"
                           value="<?php echo ucfirst($user['role']); ?>"
                           readonly>

                    <small class="text-muted">
                        You cannot change your own role.
                    </small>

                <?php } else { ?>

                    <select name="role"
                            class="form-control">

                        <option value="customer"
                        <?php if($user['role']=='customer') echo "selected"; ?>>
                            Customer
                        </option>

                        <option value="admin"
                        <?php if($user['role']=='admin') echo "selected"; ?>>
                            Admin
                        </option>

                    </select>

                <?php } ?>

            </div>

            <button class="btn btn-primary"
                    name="update_user">
                Update User
            </button>

        </form>

    </div>

</div>

<?php include '../includes/footer.php'; ?>