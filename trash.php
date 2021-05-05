<?php
include_once 'crud.php';

$tasklist= new TaskList();


if(isset($_POST['submit'])){
  $tasklist->insertTask($_POST);
}
// Delete record from table
  if(isset($_GET['delete_id'])) {
      $delete_id = $_GET['delete_id'];
      $tasklist->deleteTrash($delete_id);
  }
// Restore trash
  if(isset($_GET['restore_id'])) {
    $restore = $_GET['restore_id'];
    $tasklist->restoreTrash($restore);
    $tasklist->deleteTrash($restore);
  }

?>

 

<!doctype html>
<html lang="en">

<head>
  <title>Sidebar 01</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">


</head>

<body>
  <!-- Side nav  -->
  <div class="wrapper d-flex align-items-stretch" style="margin-top:60px">
    <nav id="sidebar" style="background-color:#dac292">
      <div class="p-4 pt-5 mt-5">
        <ul class="list-unstyled components mb-5">
          <li><a href="index.php" style="color:black"  id="show"><i class="fas fa-home px-4"></i>Home</a></li>
          <li> <a style="color:black"> <i class="fa fa-sticky-note px-4"></i> Reminder</a></li>
          <li> <a href="#" style="color:black"> <i class="fa fa-bell px-4"></i> Notification</a></li>
          <li><a href="trash.php" style="color:black"><i class="fa fa-trash px-4"></i>Trash</a> </li>
        </ul>
    </nav>

    <!-- Top Nav -->
    <div id="content" class="p-4 p-md-5" style="background-color:#fefbd8">

      <nav class="navbar fixed-top justify-content-between navbar-light mb-5"
        style="box-shadow:rgba(0, 0, 0,0.5) 0px 3px 10px;background-color:white">

        <button type="button" id="sidebarCollapse" class="btn " style="background-color: transparent;color:black">
          <i class="fa fa-bars" style="font-size:30px;margin-left:0px"> Keep notes</i> </button>
        <button class="btn  d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
          data-target="#navbarSupportedContent">
          <i class="fa fa-bars"></i>
        </button>
        <!-- Search button -->
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

      </nav>
      <!-- Content -->
    <div class="container">
     <div id="list" class="card-body w-75 mt-5 h-25" style="box-shadow:rgba(0, 0, 0,.5) 0px 3px 20px;margin-top:100px;background-color:#fefbd8;margin-left:150px">
            <h5 style="text-align:center">Deleted Data</h5>
              <table class="table " style="border-top:1px solid white" >
          
      <tbody>
           <?php 
              $todo_task = $tasklist->displayTrash(); 
                foreach ($todo_task as $var_task) {
                   ?>
                  <tr>
                <td><?php echo $var_task['trash_id']?></td>
                  <td><h6 id="h6"><?php echo $var_task['trash_name']?></h6></td>
                  <td><?php echo $var_task ['date_deleted']?></td>
                    <div id="footer">
                    <td> <a type="submit" name="submit" href="trash.php?delete_id=<?php echo $var_task['trash_id'] ?>" style="color:black"><i class="fa fa-trash" aria-hidden="true"></i>
            </a></td>
                    <td> <a type="submit" name="submit" href="trash.php?restore_id=<?php echo $var_task['trash_id'] ?>" style="color:black"><i class="fa fa-undo-alt" aria-hidden="true"></i>
            </a></td>
                  </div>
                  </tr>
               <?php } ?>
   </tbody>
    </table>
    </div> 
    </div>
    </div> 
    </div>
  </div>
  <script src="./js/jquery.min.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>
