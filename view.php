<?php 
session_start();
if(isset($_GET['profile_id']))
{
    include 'init.php';  
}


?>

<?php
// Check that the contact ID exists
if (isset($_GET['profile_id']) && ($_SERVER['REQUEST_METHOD']!='POST')) {
    // Select the record that is going to be deleted
    $stmt=$con->prepare("select  profile_id,first_name,last_name,email,headline,summary from profile where profile_id=?");
    $stmt->execute(array($_GET["profile_id"])); 
    $Userprofile=$stmt->fetch(PDO::FETCH_ASSOC);      
    if (!$Userprofile) {
        exit('Userprofile doesn\'t exist with that profile_id!');
    }
   
}
else {
   // exit('No ID specified!');
}


if (isset($_POST['cancel']) )
{ 
  if($_POST['cancel'] == 'Done'){

    header('Location: index.php');
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
<h1>Profile information</h1>
 
 <form name="f1" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" > 
    <p>First Name:
   <?=isset($Userprofile['first_name'])?$Userprofile['first_name']:''?></p>
    <p>Last Name:
   <?=isset($Userprofile['last_name'])?$Userprofile['last_name']:''?></p>
   <p>Email:
   <?=isset($Userprofile['email'])?$Userprofile['email']:''?></p>
   <p>headline:
   <?=isset($Userprofile['headline'])?$Userprofile['headline']:''?></p>
   <p>summary: <br>
   <?=isset($Userprofile['summary'])?$Userprofile['summary']:''?></p>

   <p>
    <input type="submit" name="cancel" value="Done">
    </p>   
    </form>
</div>
</body>
</html>