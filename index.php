<?php
include_once 'crud.php';

$tasklist= new TaskList();


if(isset($_POST['submit'])){
  $tasklist->insertTask($_POST);
}
// Delete record from table
  if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $tasklist->deleteTask($id);
  }
// Update task
  if(isset($_GET['id_edit'])){
    $id=$_GET['id_edit'];
    $updateTask= $tasklist->update($id);
  }
// Updated Task
  if(isset($_POST['update'])){
    $tasklist->updated();
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {

        $('#addTask').on('click', function() {
            $('#new').toggle();
        })
        $('#show').on('click', function() {
            $('#list').toggle();
        })
        $('#list').mouseover(function() {
            $('#footer').show();
        })
        $('#list').mouseout(function() {
            $('#footer').hide();
        });

        $('.check').change(function() {


            if ($(this).prop("checked") == true) {
                $(this).parent().parent().css("text-decoration", "line-through");
            } else if ($(this).prop("checked") == false) {
                $(this).parent().parent().css("text-decoration", "none");
            }
        });

    })
    </script>
</head>

<body>
    <!-- Side nav  -->
    <div class="wrapper d-flex align-items-stretch" style="margin-top:60px ">
        <nav id="sidebar" style="background-color:#dac292;">
            <div class="p-4 pt-5 mt-5">
                <ul class="list-unstyled components mb-5">
                    <li><a href="index.php" style="color:black" id="show"><i class="fas fa-home px-4"></i>Home</a></li>
                    <li> <a style="color:black"> <i class="fa fa-sticky-note px-4"></i> Reminder</a></li>
                    <li> <a href="#" style="color:black"> <i class="fa fa-bell px-4"></i> Notification</a></li>
                    <li><a href="trash.php" style="color:black"><i class="fa fa-trash px-4"></i>Trash</a> </li>
                </ul>
        </nav>

        <!-- Top Nav -->
        <div id="content" class="p-4 p-md-5" style="background-color:#fefbd8">

            <nav class="navbar fixed-top justify-content-between navbar-light mb-5"
                style="box-shadow:rgba(0, 0, 0,0.5) 0px 3px 10px;background-color:white">

                <button type="button" id="sidebarCollapse" class="btn "
                    style="background-color: transparent;color:black">
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
                <div id="list" class="card-body w-75 mt-2 "
                    style="box-shadow:rgba(0, 0, 0,.5) 0px 3px 20px;margin-top:100px;background-color:#fefbd8;margin-left:150px">
                    <h5>To-Do-List<button id="addTask" class="btn btn-outline-secondary"
                            style="float:right;margin:10px"><i class="fa fa-plus text-dark"></i></button></h5>
                    <form action="" method="POST">
                        <div id="new" class="input-group px-0 w-75" style="display:none;">
                            <input type="text" name="todo_task"
                                class="w-75  form-control-lg border-0 add-todo-input  rounded mt-3 mb-3"
                                style="outline: none;" placeholder="Add new...">
                            <div class="input-group-append">
                                <button class="btn " name="submit" type="submit"
                                    style="background-color:transparent;"><i class="fa fa-thumbtack"></i></button>
                            </div>
                    </form>
                </div>
                <table class="table " style="border-top:1px solid white">

                    <tbody>
                        <?php 
              $todo_task = $tasklist->displayTask(); 
                foreach ($todo_task as $var_task) {
                   ?>
                        <tr>
                            <td><input class="check" type="checkbox"></td>
                            <td><?php echo $var_task['task_id']; ?></td>
                            <td>
                                <h6 id="h6"><?php echo $var_task['todo_task']?></h6>
                            </td>
                            <td><?php echo $var_task ['date']?></td>

                            <td><a data-toggle="modal"
                                    data-target="#exampleModalCenter<?php echo $var_task['task_id'] ?>" name="update"
                                    style="color:black"><i class="fa fa-pen"></i></a>&nbsp</i></td>


                            <td> <a type="submit" name="submit" href="index.php?id=<?php echo $var_task['task_id'] ?>"
                                    style="color:black"><i class="fa fa-trash" aria-hidden="true"></i>
                                </a></td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter<?php echo $var_task['task_id'] ?>" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="background-color:#fefbd8">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Update Task</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POSt">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">

                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fa fa-tasks"></i></span>
                                                </div>
                                                <input type="hidden" id="id" name="id" value="<?php echo $var_task['task_id']?>">
                                                <input type="text" class="form-control" name="taskname"
                                                    value="<?php echo $var_task['todo_task'] ?>">
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="update" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>

        <script src="./js/jquery.min.js"></script>
        <script src="./js/main.js"></script>
</body>

</html>