<?php 
session_start();
if (empty( $_SESSION['admin'])) {
  header("location: ../index2.php");
}
$conn=new mysqli("localhost","root","","groupworkclass");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: Admin_panel ::</title>
  <link rel="stylesheet" href="../stylesheet/panel.css">
</head>
<body>
  <div class="container">
    <!-- first part -->
    <div class="left_side">
      <nav>
        <ul>
        <li><a href="./admin_panel.php">Admin</a></li>
        <li><a href="./user_list.php">user list</a></li>
          <li><a href="./add_task.php">add_task</a></li>
          <li><a href="./report.php">Report</a></li>
          <li><a href="./logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
    <!-- secand part -->
    <div class="right_side">
      <header>
        <h2>welcame to admin panel</h2>
        <h2><?php echo $_SESSION['admin'];?> </h2>
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
          <h2>
          <?php
            $sql=$conn->query("SELECT * FROM `tasks`");
            $result=mysqli_num_rows($sql);
            echo $result;
             ?>
          </h2>
          <h3>number of task</h3>
        </div>
      </div>
    </div>
  </div>
</body>
</html>