<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location: ../index.php");
}
$conn=new mysqli("localhost","root","","groupworkclass");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: user_panel ::</title>
  <link rel="stylesheet" href="../stylesheet/panel.css">
</head>
<body>
  <div class="container">
     <!-- first part -->
    <div class="left_side">
      <nav>
        <ul>
        <div class="user">TMS</div>
          <li><a href="./user_panel.php">Home</a></li>
          <li><a href="./view_task.php">view_task</a></li>
          <li><a href="./logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
      <!-- secand part -->
    <div class="right_side">
      <header>
        <h2>TRACKING MANAGEMENT SYSTEM</h2>
      <h4>welcame </h4>
        <h2><?php echo $_SESSION['username']; ?></h2>
      </header>
      <div class="collecion_cord">
        <div class="cord">
          <h2>
            <?php
            $sql=$conn->query("SELECT * FROM `users` ");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>number of users</h3>
        </div>
        <div class="cord">
          <h2>
          <?php
            $sql=$conn->query("SELECT * FROM `tasks`");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>number of task</h3>
        </div>
        <div class="cord">
        <h3>user info</h3>
          <h2>
          <?php
           $id=$_SESSION['id'];
            $sql=$conn->query("SELECT * FROM `users` WHERE `id`=$id;");
            $result=mysqli_fetch_array($sql);
            echo $result['1'] ."<br>";
            echo $result['2'] ."<br>";
             ?>
          </h2>
          
        </div>


      </div>

    </div>

  </div>
</body>
</html>