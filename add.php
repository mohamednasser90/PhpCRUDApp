<?php
session_start();
include 'init.php';

if (!isset($_SESSION['name']))
{
    die('User not logged in');
}
if (isset($_POST['cancel']) )
{ 
  if($_POST['cancel'] == 'Cancel'){

    header('Location: index.php');
  }
}
else{
  if($_POST){

 
if ( isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']))
{
   if(empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['headline'])) {
    $_SESSION['error'] = 'All fields are required';
  }
    elseif (strpos($_POST['email'], '@') === false)
    {
        $_SESSION['error'] = 'Email address must contain @';
    }
    
    else if (!empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['email']) || !empty($_POST['headline']))   
    {
      $stmt=$con->prepare("insert into profile (user_id ,first_name,last_name,email,headline,summary)
      values (:zuser,:zfname,:zlname,:zemail,:zheadline,:zsummary) ");
      $stmt->execute(array(
          'zuser' => $_SESSION['ID'],
          'zfname' => $_POST['first_name'],
          'zlname' => $_POST['last_name'],
          'zemail' => $_POST['email'],
          'zheadline' =>$_POST['headline'],
          'zsummary' =>  $_POST['summary'],

        //   ':first_name' => $_POST['first_name'],
        //   ':last_name' => $_POST['last_name'],
        //   ':email' => $_POST['email'],
        //   ':headline' => $_POST['headline'],
        //   ':summary' => $_POST['summary'],
        //   ':profile_id' => $_GET['profile_id'])

      ));
        $_SESSION['success'] = 'Profile added';
        header('Location: index.php');
        return;
    }
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Mohamed Nasser's Resume Registry</title>


</head>
<body>
<div class="container">
    <h1>Adding Profile for UMSI</h1>
    <?php
    if (isset($_SESSION['error']))
    {
        echo('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
        unset($_SESSION['error']);
    }
    ?>
    <form method="POST">
        <p>First Name:
            <input type="text" name="first_name"  /></p>
        <p>Last Name:
            <input type="text" name="last_name"  /></p>
        <p>Email:
            <input type="text" name="email" /></p>
        <p>Headline:<br/>
            <input type="text" name="headline"  /></p>
        <p>Summary:<br/>
            <textarea name="summary" rows="8" ></textarea>
        <p>
            <input type="submit" value="Add">
            <input type="submit" name="cancel" value="Cancel">
        </p>
    </form>

</div>
</body>
</html>





