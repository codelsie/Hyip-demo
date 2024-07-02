<?php
   require '../connection.php'; 
   require "header.php";


   if (!isset($_SESSION['user'])) {
    header('Location: ../signin.php');
    exit();
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_SESSION['user']['id'];
        $amount = $_POST['amount'];

        $sql = "INSERT INTO user_deposits (user_id, deposit_amount) VALUES ('$user_id', '$amount')";

        if ($conn->query($sql) === TRUE) {
            $status = "Deposit recorded successfully.";
        } else {
            $status = "Error: " . $conn->error;
        }
    }
?>

<?php if(isset($status)): ?>
<div class="alert alert-success my-3">
    <?php echo $status; ?>
</div>
<?php endif; ?>

<div class="container py-4">
        <h1>Make a Deposit</h1>
        <form method="POST" action="">
            <label for="amount">Deposit Amount:</label>
            <input type="number" step="0.01" id="amount" name="amount" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php require 'footer.php'; ?>