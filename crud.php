<?php

// $mysqli = new mysqli('localhost','root','','to-do-list') or die(mysqli_error($mysqli));

// $task = '';
// if(isset($_GET['id_edit'])){

//     $id = $_GET['id_edit'];
//     $result = $mysqli->query("SELECT * FROM tasks WHERE task_id='$id'");
//     $row = mysqli_fetch_array($result);

//     $task = $row['todo_task'];
    
//     header("location: update.php");

// }
   

    class TaskList {
        public $servername='localhost';
        public $username='root';
        public $password='';
        public $database='to-do-list';

        protected $con;
    public function __construct(){
        $this->con= new MYSQLI($this->servername, $this->username,$this->password, $this->database);
        if(mysqli_connect_error()){
            echo "Failed to Connect to mysqli";
        }else{
            return $this->con;
        }
    }

        public function insertTask($query)
        {
        
            $todo_task=$_POST['todo_task'];
            $query="INSERT into tasks (todo_task) VALUES('$todo_task')";
            $result=$this->con->query($query);
            if($result==true)
            {
               header('index.php');
            }else{
                echo "Can't add data!";
            }
    }
    //    Fetch customer records for show listing
		public function displayTask()
		{
		    $query = "SELECT * FROM tasks";
		    $result = $this->con->query($query);
		    if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
			    return $data;
		    }else{
			 echo "No found records";
		    }
		}

            // Update task
        public function update($postdata){
        $query="SELECT * FROM tasks where task_id = '$id'";
        $result=$this->con->query($query);
        if($result->num_rows>0){
            $row=$result->fetch-assoc();
            return $row;
        }else{
            echo 'Record not found!';
        }
        }
        // Updated Task
        public function updated(){
            $updatedtask=$_POST['taskname'];
            $id=$_POST['id'];
            $query="UPDATE tasks SET todo_task ='$updatedtask' WHERE task_id = '$id'";
            $result=$this->con->query($query);
            if($result==true){
                return true;
                // header('location:index.php');
            }else{
                echo "Failed!";
            }
        }
        
        // Delete specific task
        public function deleteTask($id){
            $insert="INSERT into trash (trash_name) SELECT todo_task FROM tasks WHERE task_id='$id'";
            $sql=$this->con->query($insert);
            $query= "DELETE FROM tasks where task_id ='$id'";
            $result=$this->con->query($query);

            if($result==true){
                return true;
                header('index.php');
            }
        }
            // Show trash
         //    Fetch customer records for show listing
		public function displayTrash()
		{
		    $query = "SELECT * FROM trash";
		    $result = $this->con->query($query);
		    if ($result->num_rows > 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
			    return $data;
		    }else{
			 echo "No found records";
		    }
		}
        public function deleteTrash($delete_id){
            $query= "DELETE FROM trash where trash_id ='$delete_id'";
            $result=$this->con->query($query);

            if($result==true){
                return true;
                header('trash.php');
            }
        }
		public function restoreTrash($restore){
            $query="INSERT into tasks (todo_task) SELECT trash_name FROM trash WHERE trash_id='$restore'" ;
            $result=$this->con->query($query);
            $delete="DELETE FROM trash where trash_id ='$restore'";
            $sql=$this->con->query($delete);
        }
    }


// $task=new TaskList();
?>