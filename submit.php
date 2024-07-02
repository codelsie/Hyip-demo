<?php require 'connection.php';
   
   $name = $_POST['person_name'];
   $email = $_POST['email'];
   $password = $_POST['password'];


   $sql = "INSERT INTO users (`name`, email, `password`, user_balance) VALUES ('$name', '$email', '$password', 0)";

   if($conn->query($sql) === TRUE) {
      // redirect to login
      header("location: ./signin.php");
      die();
   }else{
      echo "Error creating users: " . $sql . "<br>" . $conn->error;
   }

   $conn->close();
?>
