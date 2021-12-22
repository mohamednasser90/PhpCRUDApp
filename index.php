<?php
session_start();
include 'init.php';

$stmt = $con->prepare("SELECT profile_id, first_name,last_name , headline from profile");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohamed Nasser's Resume Registry 79f3d05b</title>
</head>
<body>
<div class="container">
    <h1>Mohamed Nasser's Resume Registry</h1>

    <?php
    if (isset($_SESSION['name'])) {
        echo '<p><a href="logout.php">Logout</a></p>';
    }
    if (!isset($_SESSION['name']))
    {
        echo '<p><a href="login.php">Please log in</a></p>';
    }
    ?>
    <?php
    if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION['success']);
    }
    ?>


  

    <table border= "1" style="border-collapse: collapse;">
        <thead>
            <th>Name</th>
            <th>Headline</th>     
            <?php     
            if(isset($_SESSION['name'])){ ?>
                <th>Action</th>      
           <?php }
            ?>   
        </thead>
        <tbody>
            <?php   foreach($rows as $row):   ?>

            <tr>
                <td><a href="view.php?profile_id=<?=$row['profile_id']?>"><?=$row['first_name']." ".$row['last_name']?></a></td>
                <td><?=$row['headline']?></td>
               <?php if(isset($_SESSION['name'])){ ?>
               <td>
                <a href="edit.php?profile_id=<?=$row['profile_id']?>">Edit</a> 
                <a href="delete.php?profile_id=<?=$row['profile_id']?>">Delete</a>
                </td> 
            <?php }      ?>   
            </tr>
            <?php  endforeach;   ?>
        </tbody>
    </table>

    <?php  
     if(isset($_SESSION['name'])){  
             echo '<a href="add.php">Add New Entry</a>';  
         }
         ?>   
         
         <p>
            <b>Note:</b> Your implementation should retain data across multiple
            logout/login sessions. This sample implementation clears all its
            data periodically - which you should not do in your implementation.
        </p>
         
</div>
</body>
</html>