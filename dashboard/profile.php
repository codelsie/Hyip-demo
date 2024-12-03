<?php require "header.php";
require "../connection.php";

$user = getUser();
?>

<div class="container py-3">
    <h1>My Info</h1>
    <div class="user-info">
        <div class="user-info-item">
            <strong>name:</strong>
            <span><?php echo $user['name']; ?></span>
        </div>
        <div class="user-info-item">
            <strong>Email:</strong>
            <span><?php echo $user['email']; ?></span>
        </div>

    </div>
</div>

<?php require "footer.php"; ?>