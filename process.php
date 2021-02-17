<?php 

session_start();

$name='';
$city='';
$college='';
$update=false;
$id = 0;
$mysqli = new mysqli('localhost','root','','admin_panel') or die(mysqli_error($mysqli));

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $city = $_POST['city'];
    $college = $_POST['college'];

    

    $mysqli->query("INSERT INTO data(name,city,college) VALUES('$name','$city','$college')") or die($mysqli->error);
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:dashboard1.php");
    }

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id = $id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:dashboard1.php");
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id = $id") or die($mysqli_error());
    if($result->num_rows){
        $row=$result->fetch_array();
        $name= $row['name'];
        $city = $row['city'];
        $college = $row['college'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $city = $_POST['city'];
    $college = $_POST['college'];

    $mysqli->query("UPDATE data SET name = '$name', city = '$city', college = '$college' WHERE id = $id") or die($mysqli->error());
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location:dashboard1.php");
}
?>