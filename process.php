<?php


session_start();

$update = false;
$id = 0;
$name = "";
$email = "";

$mysqli = new mysqli('localhost', 'username', 'password', 'crud') or die(mysqli_error($myqli));

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];


    $mysqli->query("INSERT INTO data (name, email) VALUES('$name', '$email')") or die("Error while querying database");

    $_SESSION['message'] = "You've added your record";
    $_SESSION['alert'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){

    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Your record has been deleted";
    $_SESSION['alert'] = "danger";
    
    header("location: index.php");
}

if(isset($_GET['edit'])){
    
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die("Error querying database");

    if(!empty($result)){
        $row = $result->fetch_array();
        $name = $row['name'];
        $email = $row['email'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $mysqli->query("UPDATE data SET name='$name', email='$email' WHERE id=$id") or die("Error while querying database");

    $_SESSION['message'] = "Your record has been updated";
    $_SESSION['alert'] = "success";

    header("location: index.php");
}
?>
