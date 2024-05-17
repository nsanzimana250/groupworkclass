<?php
session_start();
if (!empty($_SESSION['username'])) {
    header("location:./user_panel/user_panel.php");
  }
if (!empty($_SESSION['admin'])) {
    header("location:./Admin_panel/admin_panel.php");
  }
$conn=new mysqli("localhost","root","","groupworkclass");
$username=$email=$password=$cpassword="";
if (isset($_POST['login'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql=$conn->query("SELECT * FROM `users` WHERE `username`='$username'");
    $result=$sql->fetch_assoc();
    if ($result) {
        if (password_verify($password, $result['password'])) {
                    $_SESSION['id']=$result['id'];
                    $_SESSION['username']=$result['username'];
                    header("location:./user_panel/user_panel.php");
                }
                else{
                            echo"<script>alert(' Worng  Password ')</script>   ";
                        } 
            }
        else{
           echo"<script> alert(' Worng  Username ')</script>   ";
          }
}    
 ?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: login form ::</title>
    <link rel="stylesheet" href="./stylesheet/style.css">
</head>
<body>
    <header>
        <h2>TRACKING MANAGEMENT SYSTEM</h2>
        <h3>:: Login Form for user ::</h3>
    </header>
    <div class="form">
        <h2>login if you are user</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" >Login</button>
            <p>if you don't have an account <a href="./create.php">create it now</a> </p>
            <p>if you are admin  <a href="./index2.php">login us admin</a> </p>
        </form>
    </div>
</body>
</html>