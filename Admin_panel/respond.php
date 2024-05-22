<?php 
session_start();
if (empty( $_SESSION['admin'])) {
  header("location: ../index2.php");
}
$table=false;
$conn=new mysqli("localhost","root","","groupworkclass");
if (isset($_POST['search'])) {
  $date=$_POST['date'];
  $table=true;
}
if (isset($_GET['detele'])) {
  $id=$_GET['detele'];
  $sql=$conn->query("DELETE FROM `comment` WHERE `task_id`=$id");
  header("location: respond.php");
}
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
          <div class="user">TMS</div>
        <li><a href="./admin_panel.php">Admin</a></li>
        <li><a href="./user_list.php">user list</a></li>
          <li><a href="./add_task.php">add_task</a></li>
          <li><a href="./respond.php">message</a></li>
          <li><a href="./report.php">Report</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
    <!-- secand part -->
    <div class="right_side">
      <header>
        <h2>welcame admin this is message from user response</h2>
        <h2><?php echo $_SESSION['admin'];?> </h2>
      </header>
      <div class="collecion_cord">
          <?php
          $sql=$conn->query("SELECT * FROM `comment` INNER JOIN tasks WHERE comment.task_id=tasks.id");
          while ($data=$sql->fetch_array()) { ?>
            <div class="cord">
              <h3>prject title:</h3>
              <p><?php echo $data["title"] ?></p>
              <h3>status:</h3>
              <p><?php echo $data["comment"] ?></p>
              <h3>message:</h3>
              <p><?php echo $data["message"] ?></p>
              <a href="?detele=<?php echo $data[0] ?>">delete</a>
            </div>
      <?php    }    ?>
        </div>
     



    </div>
  </div>
</body>
</html>
