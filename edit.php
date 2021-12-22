<?php 
session_start();
include 'init.php';

if (!isset($_SESSION['name']))
{
    die('User not logged in');
}

if (isset($_POST['first_name']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']))
{
   if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['headline'])) {
    $_SESSION['error'] = 'All Field Required';
  }
  else if (strpos($_POST['email'], '@') === false)
    {
        $_SESSION['error'] = 'Email address must contain @';
    }
    
    else if (!empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['email']) || !empty($_POST['headline']))   
    {   
    
        $sql = "UPDATE profile SET first_name = :first_name, last_name = :last_name,email=:email,headline=:headline,summary=:summary WHERE profile_id = :profile_id";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(
                ':first_name' => $_POST['first_name'],
                ':last_name' => $_POST['last_name'],
                ':email' => $_POST['email'],
                ':headline' => $_POST['headline'],
                ':summary' => $_POST['summary'],
                ':profile_id' => $_GET['profile_id'])
        );
        $_SESSION['success'] = 'profile updated';
        header('Location: index.php');
        return;
    }
}
if (!isset($_GET['profile_id']))
{
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
}
$stmt = $con->prepare("SELECT * FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false)
{
    $_SESSION['error'] = 'Bad value for user_id';
    header('Location: index.php');
    return;
}


?>



<!DOCTYPE html>
<html>
<head>
<title>Mohamed Nasser's Resume Registry</title>


</head>
<body>
<div class="container">
    <h1>Editing Profile for UMSI</h1>
    <?php
    if (isset($_SESSION['error']))
    {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="post">
        <p>First Name:
            <input type="text" name="first_name" size="60" value="<?php echo $row['first_name'] ?>"/></p>
        <p>Last Name:
            <input type="text" name="last_name" size="60" value="<?php echo $row['last_name'] ?>"/></p>
        <p>Email:
            <input type="text" name="email" size="30" value="<?php echo $row['email'] ?>"/></p>
        <p>Headline:<br/>
            <input type="text" name="headline" size="80" value="<?php echo $row['headline'] ?>"/></p>
        <p>Summary:<br/>
            <textarea name="summary" rows="8" cols="80"><?php echo $row['summary'] ?></textarea>
        <p>
            <input type="submit" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>

</div>
</body>
</html>

