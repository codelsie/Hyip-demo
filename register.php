<?php require 'header.php'; ?>
    <form method="POST" action="submit.php">
        <div class="container">
            <h1>Eevestment Hub Registration Form</h1>
            <p>Register below to join now</p>
            <hr><br>
            <label><b>Name:</b></label>
            <input type="text"  placeholder="write your name" name='person_name' required><br><br>

            <label><b>Email:</b></label>
            <input type="email" placeholder="write your email" name="email" required></input><br><br>

            <label><b>password:</b></label>
            <input type="password" placeholder="write your password" name="password" required></input><br><br>

            <input type="hidden" name="security_key" value="<?php echo rand(100, 10000); ?>">

            <button type="submit"  class= "register" >Register</button>
              
        </div>
    </form>
<?php require 'footer.php'; ?>