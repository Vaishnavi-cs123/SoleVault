<?php
session_start();
include 'includes/db.php';

if(isset($_POST['send']))
{
    $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $subject = mysqli_real_escape_string($conn,$_POST['subject']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    mysqli_query($conn,"INSERT INTO contact_messages(fullname,email,subject,message)
    VALUES('$fullname','$email','$subject','$message')");

    echo "<script>alert('Thank you for your feedback!');</script>";
}

include 'includes/header.php';
?>

<div class="container mt-5">

    <h2 class="text-center mb-4">Contact Us</h2>

    <div class="card shadow mb-4">
        <div class="card-body">

            <h4>About SoleVault</h4>

            <p>
                SoleVault is an online shoe store created to provide customers
                with quality footwear for every occasion. We offer a variety of
                shoes for men and women, including sports, casual, road running,
                and fancy shoes. Our goal is to provide a simple, secure, and
                enjoyable shopping experience.
            </p>

        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">

            <h4>Contact Information</h4>

            <p><strong>Email:</strong> support@solevault.com</p>

            <p><strong>Phone:</strong> +91 9769418371</p>

            <p><strong>Address:</strong> Mumbai, Maharashtra, India</p>

            <p>
                If you have any questions, suggestions, or face any issues while
                using SoleVault, feel free to contact us or submit your feedback
                using the form below.
            </p>

        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <h4 class="mb-3">Send Us Your Feedback</h4>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text"
                           name="fullname"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text"
                           name="subject"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message"
                              class="form-control"
                              rows="5"
                              required></textarea>
                </div>

                <button type="submit"
                        name="send"
                        class="btn btn-dark">
                    Send Feedback
                </button>

            </form>

        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>