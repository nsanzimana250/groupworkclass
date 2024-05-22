 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: login if you are admin ::</title>
    <link rel="stylesheet" href="./stylesheet/style.css">
</head>
<body>
    <header>
        <h2>TRACKING MANAGEMENT SYSTEM</h2>
        <h3>:: Login Form for Admin ::</h3>
    </header>
    <div class="php">
    <?php
        session_start();
        if (!empty($_SESSION['admin'])) {
            header("location:./Admin_panel/admin_panel.php");
        }
        if (!empty($_SESSION['username'])) {
            header("location:./user_panel/user_panel.php");
        }
        $user="Admin";
        $pass="Admin";
        if (isset($_POST['login'])) {
            $username=$_POST['username'];
            $password=$_POST['password'];
            if ($pass==$password && $user==$username) {
                $_SESSION['admin']='Admin';
                header("location:./Admin_panel/admin_panel.php");
            }
            else{
                echo"<script> alert('You Are not Admin')</script>   ";
            }  
        }    
 ?>  

    </div>
    <div class="form">
        <h2>login form</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" >Login</button>
            <p>if you are user <a href="./index.php">login As A user </a> </p>
        </form>
    </div>
</body>
</html>