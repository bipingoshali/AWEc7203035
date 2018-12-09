<?php
header('Content-type: application/json');
if(isset($_GET['download'])){
    header('Content-disposition: attachment; filename=user.json');
}

$con=mysqli_connect("localhost","root","","awec7203035");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$query = "select * from user";
$result = mysqli_query($con,$query);
$rows = array();
while($r = mysqli_fetch_assoc($result)) {
$rows['object_name'][] = $r;
}

print json_encode($rows);