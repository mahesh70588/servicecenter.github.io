<?php
$nameError="";
$passwordError="";
if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];

if(empty($username)){
    $nameError="name is required";
}

if (empty($password)) {
    $passwordError = "Password is required";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">



   
    <link rel="stylesheet" href="stykeaditi.css">
    <title>Register</title>

    
</head>
<body>
      <div class="container">
        <div class="box form-box">
        <?php 
         //for including configuration etails
         include("php/config.php");
         if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($con,$_POST['username']);
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
// to make password encrypt
            $pass=password_hash($password,PASSWORD_BCRYPT);
            $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

            //for generating random token
            $token=bin2hex(random_bytes(15));


 
         //verifying the unique email
         $emailquery ="select * from users where email='$email'";
         $query=mysqli_query($con,$emailquery);
         $emailcount=mysqli_num_rows($query);
         if($emailcount>0){
            echo "<div class='message'>
            <p>Email Already Exist!</p>
        </div>
          <br>";
          echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        }
          else{
            if($password===$cpassword){
                $insertquery="insert into users (username,email,mobile,password,cpassword,token,status) VALUES('$username','$email','$mobile','$pass','$cpass','$token','inactive')";
                $iquery=mysqli_query($con,$insertquery);
                if($iquery){
                    echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";

                } 
            }
            else{
                echo "<div class='message'>
            <p>Password and Confirm Password Doesn't match!</p>
        </div>
          <br>";
          echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";

            }
          }
           
        }
      

        else {
            ?>
             <header>Sign Up</header>
                        <form action="" method="post">
                            <div class="field input">
                                <label for="username">Username</label>
                                
                                <input type="text" name="username" id="username"  autocomplete="off" required>
                                
                                <span style="color:red;"><?php echo $nameError ?></span>
                            </div>
            
                            <div class="field input">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email"  autocomplete="off" required>
                                <span style="color:red;"><?php echo $passwordError ?></span>
                            </div>
            
                            <div class="field input">
                                <label for="mobile">Mobile</label>
                                <input type="tel" name="mobile" id="mobile" autocomplete="off" required>
            
                            </div>
            
                                <div class="field input">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" autocomplete="off" required>
                            </div>
            
                        
                            <div class="field input">
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" autocomplete="off" required>
            </div>
                            <div class="field">
                                
                                <input type="submit" class="btn" name="submit" value="Register" required>
                            </div>
                            <div class="links">
                                Already a member? <a href="index.php">Sign In</a>
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                  </div>
            
                  
            
            
                
            </body>
            </html>