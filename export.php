<?php 
if(isset($_POST['export'])){
    $conn = mysqli_connect("localhost","root","","admin_panel");
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition:attachment; filename=data.csv');
    $output =fopen("php://output","w");
    fputcsv($output,array('ID','Name','City','College'));
    $query = "SELECT * from data ORDER BY id DESC";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_assoc($result)){
        fputcsv($output, $row);
    }
    fclose($output);
}
?>