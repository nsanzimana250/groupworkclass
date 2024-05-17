<?php 
session_start();
if (empty( $_SESSION['admin'])) {
  header("location: ../index2.php");
}
$conn=new mysqli("localhost","root","","groupworkclass");
if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $sql=$conn->query("DELETE FROM users WHERE id='$id'");
  header("location: user_list.php");
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
        <li><a href="./admin_panel.php">Admin</a></li>
        <li><a href="./user_list.php">user list</a></li>
          <li><a href="./add_task.php">add_task</a></li>
          <li><a href="./report.php">Report</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
    <!-- secand part -->
    <div class="right_side">
      <header>
        <h2>welcame this is the list of users</h2>
        <h2><?php echo $_SESSION['admin'];?> </h2>
      </header>
      <!-- table -->
      <div class="table2">
      <table border="1">
        <tr>
          <th colspan="10" >users available</th>
        </tr>
        <tr>
          <th>0N</th>
          <th>userbame</th>
          <th>email</th>
          <th>create at</th>
          <th>delete</th>
        </tr>
        <?php
            $sql=$conn->query("SELECT * FROM `users`");
            $num=1;
            while ($row=$sql->fetch_array()) { ?>
            <tr>
            <td><?php echo $num; ?></td>
              <td><?php echo $row[1]; ?></td>
              <td><?php echo $row[2]; ?></td>   
              <td><?php echo $row[4]; ?></td>  
              <th class="d" ><a class="d"  href="?delete=<?php echo $row[0]; ?>">delte</a></th> 
            </tr>
            <?php $num++; }  ?>
      </table>

      </div>



    </div>
  </div>
</body>
</html>