<?php

class Investment
{
    public function get_active_investments(): mysqli_result
    {
        global $conn;
        $sql = "SELECT * FROM user_investments WHERE investment_status = 'active'";
        $result = $conn->query($sql);
        return $result;
    }

    // increase active investment == soup
    public function increase_active_investments(): void
    {
        $investment = $this->get_active_investments();
        if($investment->num_rows > 0) {
            while($row = $investment->fetch_assoc()) {
                $this->process_active_investment($row);
            }
        };
    }

    /**
     * @param array $row    The active investment
     */
    public function process_active_investment(array $row)
    {
        /**
         * @var array The investment plan of the active investment
         */
        $investment_plan = $this->get_investment_plan($row['investment_plan_id']);

        /**
         * @var array The user of the active invesment
         */
        $investment_user = $this->get_investment_user($row['user_id']);

        $daily_increase_percentage = (int)$investment_plan["daily_increase"];
        $investment_amount = (int)$row['investment_amount'];

        // This is the amount that will be added daily to the investment balance
        $daily_increase_amount =  $investment_amount * $daily_increase_percentage / 100;

        /**
         * $date == The expiry date of the active investment
         */
        $date = new DateTime($row['investment_date']);
        $date->modify("+{$investment_plan['expiry_day']} day");


        /**
         * $now == The current date
         */
        $now = new DateTime();

        $last_update = new DateTime($row['last_update']);  // accessed last_update column
        $interval = $last_update->diff($now);

        if($now >= $date) {
            // investment expired
            $this->handle_expiration($row);
            return;
            /**
             * Call a function that will handle the expiration
             * Then return
             */
        } elseif($interval->days > 0) {
            $this->increase_investment_balance($row, $daily_increase_amount);
            $this->update_last_update($row['id']);

            // Call a function to increase the investment_balance
        }
    }

    public function get_investment_plan(int $investment_id): ?array
    {
        global $conn;
        $sql = "SELECT * FROM investment_plans WHERE id = '$investment_id'";
        $result = $conn->query($sql)->fetch_assoc();
        return $result;
    }

    public function get_investment_user(int $user): ?array
    {
        global $conn;
        $sql = "SELECT * FROM users WHERE id = '$user'";
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }


    public function handle_expiration(array $investment): bool
    {
        global $conn;
        $sql = "UPDATE user_investments SET investment_status = 'expired' WHERE id = '{$investment['id']}'";
        return $conn->query($sql);
    }


    public function increase_investment_balance(array $investment, float $amount): void
    {
        global $conn;
        $new_balance = (float) $investment['investment_balance'] + $amount;
        $sql = "UPDATE user_investments SET investment_balance = '$new_balance' WHERE id = '{$investment['id']}'";
        $conn->query($sql);
    }


    public function update_last_update($investment_id)
    {
        global $conn;
        $now = new DateTime();
        $now_formatted = $now->format('Y,m,d,H,i,s');
        $sql = "UPDATE user_investments SET last_update = '$now_formatted' WHERE id = '$investment_id'";
        $conn->query($sql);
    }

}
$investment = new Investment();
$investment->increase_active_investments();
