<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin')
{
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';

/* Delete User */
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    // Prevent admin from deleting themselves
    if($id != $_SESSION['user_id'])
    {
        mysqli_query($conn,
        "DELETE FROM users WHERE id='$id'");
    }

    header("Location: users.php");
    exit();
}

$result = mysqli_query($conn,
"SELECT * FROM users");

include '../includes/header.php';
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">

        <h2>Manage Users</h2>

        <a href="dashboard.php"
           class="btn btn-secondary">
            ← Dashboard
        </a>

    </div>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th width="180">Actions</th>
            </tr>

        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

            <tr>

                <td><?php echo $row['id']; ?></td>

                <td><?php echo $row['fullname']; ?></td>

                <td><?php echo $row['email']; ?></td>

                <td><?php echo ucfirst($row['role']); ?></td>

                <td>

                    <a href="edit_user.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    <?php if($row['id'] != $_SESSION['user_id']) { ?>

                    <a href="users.php?delete=<?php echo $row['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this user?')">
                        Delete
                    </a>

                    <?php } ?>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

<?php include '../includes/footer.php'; ?>