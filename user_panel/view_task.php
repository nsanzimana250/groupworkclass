<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location: ../index.php");
}
$conn=new mysqli("localhost","root","","groupworkclass");

  if (isset($_POST['send'])) {
  $task=$_POST['task'];
  $complet=$_POST['complet'];
  $message=$_POST['message'];
  $sql=$conn->query("INSERT INTO `comment`(`task_id`, `comment`, `message`) VALUES ('$task','$complet','$message')");
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
    }textarea{
      outline: none;
      justify-content: center;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
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
     <div class="message">
     <form  method="post">
        <h5>send message to Admin</h5>
        <textarea name="message" id="" placeholder="message"></textarea>
        <select name="task" id="">
          <option value="">select project</option>
         
          <?php 
          $sql=$conn->query("SELECT * FROM `tasks` WHERE tasks.assigned_to='$id'");
          while($row=$sql->fetch_array()){ ?>
          <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
        <?php  }
          ?>
        </select>
        <select name="complet" id="">
          <option value="none">select stastus</option>
          <option value="complete">complete</option>
          <option value="pending">pending</option>
        </select>
        <button type="submit" name="send" >send</button>
      </form>

     </div>
     
    </div>
  </div>
</body>
</html>