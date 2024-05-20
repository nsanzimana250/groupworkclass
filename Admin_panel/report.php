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
  header("location: report.php");
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
        <h2>welcame admin this is report page</h2>
        <h2><?php echo $_SESSION['admin'];?> </h2>
      </header>
      <div class="form">
        <form action="" method="POST">
        <div class="under">
          <select name="date">
            <option>SELECT DATE</option>
            <?php
            $sql=$conn->query("SELECT * FROM `tasks` ");
          
            while ($row=$sql->fetch_array()) { ?>
              <option value="<?php echo $row[6]; ?>"><?php echo $row["date"]; ?></option>
            <?php }  ?>
          </select>
          </div>

          <div class="button">
            <button type="submit" name="search" >search</button>
          </div>

        </form>
      </div>
      <!-- table -->
      <div class="table2">
        <?php if($table==true): ?>
      <table border="1">
        <tr>
          <th colspan="10" >report for task</th>
        </tr>
        <tr>
          <th>0N</th>
          <th>title</th>
          <th>description</th>
          <th>deadline</th>
          <th>status</th>
          <th>assigned_to</th>
          <th>created_at</th>
          <th>tasks</th>
        </tr>
        <?php
        $sql=$conn->query("SELECT * FROM `tasks` INNER JOIN users WHERE tasks.assigned_to=users.id and tasks.date='$date' ");
            $num=1;
            while ($row=$sql->fetch_array()) { ?>
            <tr>
            <td><?php echo $num; ?></td>
              <td><?php echo $row[1]; ?></td>
              <td><?php echo $row[2]; ?></td>
              <td><?php echo $row[3]; ?></td>
              <td><?php echo $row[4]; ?></td>
              <td><?php echo $row["username"]; ?></td>
              <td><?php echo $row[6]; ?></td>
              <td><?php echo $row[7]; ?></td>
              
            </tr>
            <?php $num++; }  ?>
            <tr>
              <td colspan="10" class="u"  ><a href="./generate_pdf.php">create PDF</a></td>
            </tr>

      </table>
      <?php else: ?>
        <div class="table">
      <table border="1">
        <tr>
          <th>0N</th>
          <th>title</th>
          <th>deadline</th>
          <th>date</th>
          <th>assigned_to</th>
          <th>status</th>
          <th>description</th>
          <th>tasks</th>
        </tr>
        <?php
            $sql=$conn->query("SELECT * FROM `tasks` INNER JOIN users WHERE tasks.assigned_to=users.id");
            $num=1;
            while ($row=$sql->fetch_array()) { ?>
            <tr>
            <td><?php echo $num=1;; ?></td>
              <td><?php echo $row[1]; ?></td>
              <td><?php echo $row[3]; ?></td>
              <td><?php echo $row[6]; ?></td>
              <td><?php echo $row["username"]; ?></td>
              <td><?php echo $row[4]; ?></td>
              <td><?php echo $row[2]; ?></td>
              <td><?php echo $row[7]; ?></td>
            </tr>
              <option value=""></option>
            <?php $num++; }  ?>
      </table>

      </div>
        <?php endif; ?>

      </div>
     



    </div>
  </div>
</body>
</html>