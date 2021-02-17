<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login1</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
</head>
<body>
    <div class="container text-center">
        <form method="POST" action="#">
            <div class="form_input mt-5">
                <input type="text" name="username" placeholder="Enter your username"/>
            </div>
            <div class="form_input mt-3">
                <input type="password" name="password" placeholder="Enter your password"/>
            </div>
            <input type="submit" name="submit" value="LOGIN" class="mt-3 btn btn-primary btn-login"/>
        </form>
    </div>
    <?php 
        $host="localhost";
        $user="root";
        $password="";
        $db="admin_panel";

        $conn = mysqli_connect($host,$user,$password,$db);

        if(isset($_POST['username'])){
            $uname=$_POST['username'];
            $password=$_POST['password'];

            $sql = mysqli_query($conn,"select * from login_form where user='".$uname."'AND pass='".$password."' limit 1");

            $row=mysqli_num_rows($sql);
            if($row == 1){
                header("Location:dashboard1.php");
                exit();
            }
            else{
                echo '<script>alert("Please enter correct details!")</script>';
            }
        }
    ?>
</body>
</html>