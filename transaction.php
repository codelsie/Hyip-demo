<?php
    $sql = "UPDATE user_deposits SET deposit_status = 'success' WHERE deposit_status = 'pending'  AND paid = '0' " ;
    $conn->query($sql); // true | false

    $sql = "SELECT * FROM user_deposits WHERE deposit_status = 'success' AND paid = '0' ";
    $result = $conn->query($sql); // table object

    while($deposit_row = $result->fetch_assoc()){

        $userid = $deposit_row["user_id"];
        $sql = "SELECT * FROM users WHERE id = '$userid'";
        $user = $conn->query($sql)->fetch_assoc(); 
        
        if($user['user_balance'] === NULL) {
            $prev_balance = 0;
        } else {
            $prev_balance = 'user_balance';
        }

        $sql = "UPDATE users SET user_balance = $prev_balance + {$deposit_row['deposit_amount']} WHERE id = {$deposit_row['user_id']}";

        $balance_updated = $conn->query($sql); // true | false
        
        if($balance_updated){
            $sql = "UPDATE user_deposits SET paid = '1' WHERE paid = '0'";
            $conn->query($sql);
        }

    };