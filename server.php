<?php
$name=isset($_POST['name']) ? $_POST['name'] : '';
$email=isset($_POST['email']) ? $_POST['email'] : '';  
$message=isset($_POST['message']) ?$_POST['message'] :'';

$conn= mysqli_connect ('localhost', 'root','' ,'info');
if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO logs (name, email, message) VALUES('$name','$email','$message')";
$results=mysqli_query($conn ,$sql);

if ($results) {
    echo "<script>alert('Data inserted successfully');</script>";
} else {
    echo "<script>alert('Error inserting data');</script>";
}
//redirect to contacts.html after submission
header("Location: index.html");
?>