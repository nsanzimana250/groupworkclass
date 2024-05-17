<?php
session_start();
if (!empty($_SESSION['username'])) {
    header("location:./user_panel/user_panel.php");
  }
if (!empty($_SESSION['admin'])) {
    header("location:./Admin_panel/admin_panel.php");
  }  
$conn=new mysqli("localhost","root","","groupworkclass");
$error=array();
$username=$email=$password=$cpassword="";
if (isset($_POST['signup'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $pass=password_hash($password, PASSWORD_DEFAULT);
    $usernamecheck=$conn->query("SELECT * FROM `users` WHERE `username`='$username'");
    $emailcheck=$conn->query("SELECT * FROM `users` WHERE `email`='$email'");
    if ($usernamecheck==true) {
        $result=$usernamecheck->fetch_assoc();
        if ($result==true) {
            array_push($error,"username aleady taken  ");
        }
    }
    if ($emailcheck==true) {
        $result=$emailcheck->fetch_assoc();
        if ($result==true) {
            array_push($error," email aleady taken ");
        }
    }
    if (strlen($password)<6) {
        array_push($error,"password must be 6 or more characters  ");
    }
    if ($password!=$cpassword) {
        array_push($error,"password not much ");
    }
    if (count($error)>0) {
        foreach ($error as $key) {
            echo" 
            <script>alert('$key')</script>
            ";
        }
    }
    else{
        $emailcheck=$conn->query("INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username','$email','$pass')");
        header("location: ./index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>:: signup form ::</title>
    <link rel="stylesheet" href="./stylesheet/style.css">
</head>

<body>
    <header>
        
        <h2>TRACKING  MANAGEMENT SYSTEMANA</h2>
        <h3>:: signup Form ::</h3>
    </header>
    <div class='php'>   
    </div>
    <div class="form">
    <h2>signup form</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="cpassword" placeholder=" Comform Password" required>
            <button type="submit" name="signup" >signup</button>
            <p>Aldeady have an account <a href="./index.php">login  now</a> </p>
        </form>
    </div>
</body>
</html>