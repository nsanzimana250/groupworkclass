<?php 
session_start();
if (empty( $_SESSION['admin'])) {
  header("location: ../index2.php");
}
$conn=new mysqli("localhost","root","","groupworkclass");
if (isset($_POST['addtask'])) {
  $title=$_POST['title'];
  $deadline=$_POST['deadline'];
  $description=$_POST['description'];
  $task=$_POST['task'];
  $status=$_POST['status'];
  $assidned_to=$_POST['assidned_to'];
  $date=$_POST['date'];
  $sql=$conn->query("INSERT INTO `tasks`(`title`, `description`, `deadline`, `status`, `assigned_to`, `date`, `task`) 
  VALUES ('$title','$description','$deadline','$status','$assidned_to','$date','$task' )");
  header("location:./add_task.php");
}
$update=false;
$id=0;
$title="";
$deadline="";
$description="";
$task="";
$status="";
$assidned_to="";
$date="";
if ((isset($_GET['update']))) {
  $id=$_GET['update'];
  $update=true;
  $sql=$conn->query("SELECT * FROM `tasks` WHERE `id`='$id'");
  $result=$sql->fetch_array();
  $title=$result['title'];
  $deadline=$result['deadline'];
  $description=$result['description'];
  $task=$result['task'];
  $status=$result['status'];
  $assidned_to=$result['assigned_to'];
  $date=$result['date'];
}
if (isset($_POST['edit'])) {
  $id=$_POST['id'];
  $title=$_POST['title'];
  $deadline=$_POST['deadline'];
  $description=$_POST['description'];
  $task=$_POST['task'];
  $status=$_POST['status'];
  $assidned_to=$_POST['assidned_to'];
  $date=$_POST['date'];
  $sql=$conn->query("UPDATE `tasks` SET `title`='$title',`description`='$description',`deadline`='$deadline',`status`='$status',`assigned_to`='$assidned_to',`date`='$date',`task`='$task' WHERE `id`='$id'");
   header("location:./add_task.php");
}

if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $sql=$conn->query("DELETE FROM `tasks` WHERE `id`='$id'");
  header("location:./add_task.php");
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
        <h2>welcame admin add task and assigin to users </h2>
        <h2><?php echo $_SESSION['admin'];?> </h2>
      </header>
      <!-- form -->
      <div class="form">
        <form action="" method="POST">
          <div class="top">
            <input type="hidden" name="id" value="<?php echo$id ; ?>" >
          <input type="text" name="title" value="<?php echo $title; ?>" class="input" required placeholder="title">

          <div>
            <label for="deadline">date</label>
          <input type="date" name="date" class="input" value="<?php echo $date ; ?>"  required placeholder="deadline">
          </div>
          <div>
            <label for="deadline">deadline</label>
          <input type="date" name="deadline" class="input" value="<?php echo $deadline ; ?>"  required placeholder="deadline">
          </div>
          </div>
          <div class="middle">
            <input type="text" name="description" value="<?php echo $description ; ?>"  class="textarea" placeholder="description">
            <input type="text" name="task" class="textarea" value="<?php echo $task ; ?>"  placeholder="add task">
          </div>
          <div class="under">
          <select name="status">
            <option>SELECT STATUS</option>
            <option value="pending">pending</option>
            <option value="completed">completed</option>
          </select>
          <select name="assidned_to">
            <option>ASSIGNED TO</option>
            <?php
            $sql=$conn->query("SELECT * FROM `users`");
          
            while ($row=$sql->fetch_array()) { ?>
              <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
            <?php }  ?>
          </select>
          </div>
          <div class="button">
            <?php if($update==true): ?>
            <button type="submit" name="edit" >update task</button>
            <?php else: ?>
              <button type="submit" name="addtask" >save task</button>
            <?php endif; ?>
          

          </div>

        </form>
      </div>
      <!-- table -->
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
          <th colspan="2" >action</th>
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
              <td class="d" ><a class="d"  href="?delete=<?php echo $row[0]; ?>">Trash</a></td>
              <td class="u" ><a class="u"  href="?update=<?php echo $row[0]; ?>">Edit</a></td>
            </tr>
              <option value=""></option>
            <?php $num++; }  ?>
      </table>

      </div>




    </div>
  </div>
</body>
</html>