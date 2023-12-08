
<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("php/config.php");
              
              if(isset($_POST['submit'])){


                /*
                $email = isset($_POST['email']) ? $_POST['email'] : "";
                $password = isset($_POST['password']) ? $_POST['password'] : "";
                $email_search ="select * from user_details where Email='$email' and Status ='active'";
                $query =mysqli_query($con,$email_search);
                $email_count =mysqli_num_rows($query);
                if($email_count){
                    $email_pass=mysqli_fetch_assoc($query);
                    $db_pass =$email_pass['password'];
                    $_SESSION['username'] = isset($email_pass['username']) ? $email_pass['username'] : "";
                    $pass_decode =password_verify($password,$db_pass);
                    if($pass_decode){
                        echo "login successfully";
                        ?>
                        <script>
                            location.replace("home.php");
                        </script>
                        <?php
                    }else{
                        echo "password incorrect";
                    }}
                    else{
                        echo "Invalid Email";
                    }
                    */
                    $email =$_POST['email'];
                    $password =$_POST['password'];
                    $email_search ="select * from user_details where Email='$email'";
                    $query=mysqli_query($con,$email_search);
                    $email_count=mysqli_num_rows($query);
                    if($email_count){
                        $email_pass =mysqli_fetch_assoc($query);
                        $db_pass=$email_pass['Password'];
                        $_SESSION['username']=$email_pass['Username'];
                        $pass_decode=password_verify($password,$db_pass);
                        if($pass_decode){
                            echo "login successfully";
                            ?>
                            <script>
                                location.replace("index.php");
                                </script>
                            <?php
                        }else{
                            echo "password incorrect" ;
                        }
                    }else{
                        echo "invalid email";
                    }


                }
                







                /*
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['phone'] = $row['Phone'];
                    $_SESSION['id'] = $row['Id'];
                }else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    header("Location: home.php");
                }*/
              else{

            
            ?>
            <header>Login</header>
            
            <?php 
if (isset($_SESSION['msg'])) {
    echo "<p class='bg-success text-white px-4'>{$_SESSION['msg']}</p>";
    unset($_SESSION['msg']); // unset the session message to clear it after displaying
}
?>

            
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Forget Password? <a href="recover_email.php">Click Here</a>
                </div>
                <div class="links">
                    Don't have account? <a href="newlogin.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>