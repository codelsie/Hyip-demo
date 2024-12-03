<?php

require 'connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '{$email}' AND `password` = '{$password}' ";
    $result = $conn->query($sql);

    if($result->num_rows === 0) {
        echo "invalid username and password";
    } else {
        $user = $result->fetch_assoc();
        $_SESSION["user"] = $user;
        header("location: dashboard/index.php");
    }

}

?>
<?php require 'header.php'; ?>
    <form method="POST">
        <div class="container">
            <h1>Eevestment Hub Login Form</h1>
            <p>Login to your account now</p>
            <hr><br>
            <label><b>Email:</b></label>
            <input type="text" placeholder="write your email" name="email"></input><br><br>

            <label><b>password:</b></label>
            <input type="password" placeholder="write your password"  name="password"></input><br><br>

            <button type="submit"  class= "register" >Login</button>
              
        </div>
    </form>
<?php require 'footer.php'; ?>