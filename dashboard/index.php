<?php 
require "../connection.php";
require 'header.php'; 

        
        $user = getUser();
?>


<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

    <div class="container py-3">
    <canvas id="investmentChart" width="400" height="200"></canvas>
    <table class="table table-hover table-bordered table-striped">
        <tr>
            <th>Total-balance</th> 
            <th>Investment-amount</th>
            <th>Investment-balance</th>
            <th>Investment-date</th>
            <th>Investment-plan</th>
        </tr>
                
<?php         
            $sql = "SELECT * FROM user_investments WHERE user_id = {$user['id']}";
            $result = $conn->query($sql);
            $investmentData = [];
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()):
                    $investmentData[] = $row;
?>
        <tr>
            <td><?php echo $user['user_balance']?></td>
            <td><?php echo $row['investment_amount'];?></td>
            <td><?php echo $row['investment_balance'];?></td>
            <td><?php echo $row['investment_date'];?></td>
            <td><?php echo $row['investment_plan_id']?></td>
        </tr>

        <?php
                endwhile;
            }
        ?>
    </table>

</div>

    <script id="investmentData" type="application/json">
        <?php echo json_encode($investmentData); ?>
    </script>


    <script src="chat.js"></script>
 <?php require "footer.php"; ?>

            