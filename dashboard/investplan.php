<?php
    require '../connection.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $user = getUser();
        
        $user_id = $user['id'];
        $investmentAmount = $_POST["investment_amount"];
        $investmentPlanid = $_POST["id"];
        $investmentStatus = "pending";
        
        $balance = (float)$user['user_balance'];
        $investmentAmount = (float)$investmentAmount;

        if($balance >= $investmentAmount) {

            $sql = "INSERT INTO user_investments (user_id, investment_amount, investment_plan_id, investment_status) VALUES ('$user_id','$investmentAmount', '$investmentPlanid', '$investmentStatus')";
                
            $result = $conn->query($sql);
            
            if($result === true){
                $remaining_balance = $balance - $investmentAmount;
                $sql = "UPDATE users SET user_balance = '$remaining_balance' WHERE id = '$user_id'";
                $conn->query($sql);
                $message = "investment Successful";
            }else{
                $message = "Error transaction";
            }

        } else {

            $message = "Insufficient fund!";

        }

    };  

    require "header.php"; 
?>

    <?php
        echo $message ?? null;

        $sql = "UPDATE user_investments SET investment_status = 'active' WHERE investment_status = 'pending'";
        $conn->query($sql);
    ?>
    <div class="container py-3">
        <div class="border shadow p-3 text-bg-warning mb-3">
            Your account balance is: $<?php echo getUser()['user_balance']; ?>
        </div>
        <h1 class="display-5">Available Investment Plans</h1>

        <?php
            $plansql = "SELECT * FROM investment_plans";
            $result = $conn->query($plansql);
        ?>
        
        <div class='row'>
        <?php 
        if($result->num_rows > 0):
            while ($row = $result->fetch_assoc()): 
        ?>
            <div class='col-md-4'>
                <div class="plan-container">
                    <div class="plan-title fw-bold text-primary"><?php echo ($row["plan_name"]); ?></div>
                    <div class="plan-description"><?php echo ($row["description"]); ?></div>

                    <form action="" method="POST">
                        <div>
                            <label for="amount form-label">Amount:</label>
                            <input placeholder="input investment amount" type="number" id="amount" name="investment_amount" class="form-control" required>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="submit" class="btn btn-success my-2">
                        </div>
                    </form>
                </div>
            </div>


        
                
        <?php 
            endwhile;
        else: 
        ?>
            <p>No investment plans found.</p>
        <?php 
        endif; 
        ?>
        </div>
    </div>  

<?php require 'footer.php'; ?>
