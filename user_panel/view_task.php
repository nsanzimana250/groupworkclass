<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location: ../index.php");
}
$conn=new mysqli("localhost","root","","groupworkclass");

  if (isset($_POST['send'])) {
  $task=$_POST['task'];
  $complet=$_POST['complet'];
  $sql=$conn->query("INSERT INTO `comment`(`task_id`, `comment`) VALUES ('$task','$complet')");
  if ($sql==true) {
  echo" <script>alert('thank you')</script>";
  }
  }
          ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>:: user_panel ::</title>
  <link rel="stylesheet" href="../stylesheet/panel.css">
  <style>
    form{
      color: #000;
      gap: 10px;
      width: 100%; 
      display: flex;
      justify-content: center;
    }
    form h2{
      color: grey;
    }
    input{
      transform: scale(2.1);
      margin-left: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left_side">
      <nav>
        <ul>
          <li><a href="./user_panel.php">Home</a></li>
          <li><a href="./view_task.php">view_task</a></li>
          <li><a href="./logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
    <div class="right_side">
      <header>
      <h2>TRACKING MANAGEMENT SYSTEM</h2>
        <h2>this is your task  <?php echo $_SESSION['username']; ?></h2>
      </header>
      <!-- table -->
      <div class="table2">
      <table border="1">
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
        $id=$_SESSION['id'];
            $sql=$conn->query("SELECT * FROM `tasks` INNER JOIN users WHERE tasks.assigned_to=users.id AND tasks.assigned_to='$id' ");
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
      </table>

      </div>
     
      <form  method="post">
        <h2>if your project is done submit</h2>
        <select name="task" id="">
          <option value="">select project</option>
         
          <?php 
          $sql=$conn->query("SELECT * FROM `tasks`");
          while($row=$sql->fetch_array()){ ?>
          <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
        <?php  }
          ?>
        </select>
        <input type="checkbox" value="complete"  name="complet" >  complet
        <button type="submit" name="send" >send</button>
      </form>
    </div>
  </div>
</body>
</html>