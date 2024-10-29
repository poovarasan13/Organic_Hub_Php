<?php

include 'config.php';

session_start();

if (isset($_POST['confirm_logout'])) {
    // If the user clicked "Confirm", destroy the session
    session_unset();
    session_destroy();
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link rel="shortcut icon" type="icon" href="./images/image.png">
    <!-- Bootstrap CDN link for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="icon" href="./images/image.png">
    <!-- Custom CSS for your project -->
    <!-- <link rel="stylesheet" href="/style.css"> -->
</head>
<body>

    <div class="container mt-5">
        <h2 class="text-center">Logout</h2>
        <div class="text-center">
            <!-- Button to open the logout confirmation modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                Logout
            </button>
        </div>
    </div>

    <!-- Bootstrap Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="logoutForm" method="post">
                        <input type="hidden" name="confirm_logout" value="1">
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
