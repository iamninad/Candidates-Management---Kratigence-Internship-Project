<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="dashboard1.php">Main Menu</a>
            </li>
        </ul>
    </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left" src></i>
                    </button>
                </div>
            </nav>
    <div class="text-center">
    <?php require_once 'process.php'?>

    <?php 

        if(isset($_SESSION['message'])):?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
        </div>
        <?php endif ?>
    <div class="container">
    <?php 
        $mysqli = new mysqli('localhost','root','','admin_panel') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        //pre_r($result->fetch_assoc());
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>
    <div class="row justify-content-center">
        <form method="post" action="export.php">
            <input type="submit" name="export" value="Export to CSV" class="btn btn-info mb-5"/>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>College</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php 
                while($row = $result->fetch_assoc()):?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['city'];?></td>
                    <td><?php echo $row['college'];?></td>
                    <td>
                        <a href="dashboard1.php?edit=<?php echo $row['id'];?>"
                        class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id'];?>"
                        class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
    </div>
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name;?>" placeholder="Enter name">
            </div>
            <div class="form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="<?php echo $city;?>" placeholder="Enter city">
            </div>
            <div class="form-group">
            <label>College</label>
            <input type="text" name="college" class="form-control" value="<?php echo $college;?>" placeholder="Enter college">
            </div>
            <div class="form-group">
            <?php if($update == true):?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form> 
        </div>    
    </div>    
    </div>
    </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

    </script>
</body>
</html>