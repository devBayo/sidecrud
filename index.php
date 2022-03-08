<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PHP-CRUD</title>

</head>
<body>

    <?php require_once 'process.php'; ?>

    <?php if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?php echo $_SESSION['alert']; ?>"> 

            <?php 

                echo $_SESSION['message'];
                unset($_SESSION['message']);

            ?>

        </div>
        
    <?php endif; ?>

<div class="container">
    <?php

        $mysqli = new mysqli('localhost', 'username', 'password', 'crud') or die(mysqli_error($mysqli));

        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

    ?>

    <div class="row justify-content-center">
    <h1>PHP-CRUD SYSTEM</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th colspan="2">Action</th>
                </tr>
            
            </thead>
        <?php while ($row = $result->fetch_array()): ?>

            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>

        <?php endwhile; ?>

        </table>
    
    </div>


    <div class="row justify-content-center">

        <form action="process.php" method="POST"> 
            <input type="hidden" name="id" value="<?php echo $id ?>;">
        <div class="form-group">

        <label for="name">Name </label>
        <input type="text" name="name" placeholder="Enter your name"  value="<?php echo $name; ?>" class="form-control" required><br>
        </div>

        <div class="form-group">
        <label for="Email">Email </label>
        <input type="text" name="email" placeholder="Enter your email" value="<?php echo $email; ?>" class="form-control" required><br>
        </div>


        <div class="form-group">
        <?php  if($update == true): ?>
            <button type="submit" name="update" class="btn btn-success">Update</button>
        </div>

        <?php else: ?>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        
        <?php endif; ?>
       </div>
        </form>
    
    </div>

</div>
</body>
</html>
