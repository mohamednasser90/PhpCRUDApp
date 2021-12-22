<?php  
session_start();
if(isset($_SESSION['User_email']))
{
    header('Location: index.php');
}
include 'init.php';
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
      $email=$_POST['email'];
      $pass=$_POST['pass'];     
      $salt = 'XyZzy12*_';
      $hashedPass = md5($salt.$pass);


      //check if exist
      $stmt=$con->prepare('SELECT user_id ,email,password  FROM users where email=? and password=?');
      $stmt->execute(array($email,$hashedPass));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
     // echo $count;

     if($count >0){
        $_SESSION['ID']=$row['user_id'];
          $_SESSION['name']=$email;
          //echo ''.$_SESSION['user_id'];
          //echo $hashedPass;
         header('Location: index.php');
         exit();
     }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohamed Nasser's Login Page</title>
</head>
<body>
    <h1>Please Log In</h1>
    

    <div class="container"  style="width:500px;">                
    
                <form  method="post" >  
                     <label>Email</label>  
                     <input type="text" id="email" name="email" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" id="pw" name="pass" class="form-control" />  
                     <br />  
                     <input type="submit" name="Log In" value="Login" class="btn btn-info"  onclick="return doValidate();" /> 
                     <input type="submit"  name="Cancel" value="Cancel" onClick="window.location='index.php';return false;" class="btn btn-info"/>                   
                </form>              
               
           </div> '
           <script> 
        function doValidate() {          
    try {
        pw = document.getElementById('pw').value;
        email = document.getElementById('email').value;    
        let emailRegex=/@/;
        let result= emailRegex.test(email);   
       // alert(result);
        if (pw == null || pw == "" || email==null || email=="") {
            alert("Both fields must be filled out");
            return false;
        }else        if(result===false){
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
}
        </script>
</body>
</html>