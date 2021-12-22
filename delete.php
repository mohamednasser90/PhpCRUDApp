<?php 
session_start();
if(isset($_SESSION['name']))
{
    include 'init.php';  
}

else{
header('Location: index.php');
exit();
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
echo (isset($Userprofile['profile_id'])?$Userprofile['profile_id']:0);
if($_SERVER['REQUEST_METHOD']=='POST')
{    
  
    $stmt=$con->prepare('Delete FROM profile  where profile_id = ?');
    $stmt->execute(array($_POST['profile_id']));
    $count=$stmt->rowCount();    
   
     $_SESSION['SuccessUpdated']="Profile Deleted";
     header('Location: index.php');

}   

if (isset($_POST['cancel']) )
{ 
  if($_POST['cancel'] == 'Cancel'){

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
<h1>Deleteing Profile</h1>
    <form name="f1" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" >   
    <input type="hidden" name="profile_id" value="<?=isset($Userprofile['profile_id'])?$Userprofile['profile_id']:0?>">
    <p>First Name:
   <?=isset($Userprofile['first_name'])?$Userprofile['first_name']:''?></p>
    <p>Last Name:
   <?=isset($Userprofile['last_name'])?$Userprofile['last_name']:''?></p>
   <p>
    <input type="submit" name ="submit" value="Delete">
    <input type="submit" name="cancel" value="Cancel">
    </p>   
    </form>

    </div>
</body>
</html>