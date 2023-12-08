
<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
        
         //for including configuration etails
         include("php/config.php");
         function smtp_mailer($to,$subject, $msg){
            $mail = new PHPMailer(); 
            $mail->IsSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; 
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            //$mail->SMTPDebug = 2; 
            $mail->Username = "maheshsh.0045@gmail.com";
            $mail->Password = "mmhqfvchyeromcpl";
            $mail->SetFrom("maheshsh.0045@gmail.com");
            $mail->Subject = $subject;
            $mail->Body =$msg;
            $mail->AddAddress($to);
            $mail->SMTPOptions=array('ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false,
                'allow_self_signed'=>false
            ));
            if(!$mail->Send()){
                echo $mail->ErrorInfo;
            }else{
                session_start();
                $_SESSION['msg'] = "Check your email to Activate your account $email";
                header('location:login.php');

                //return  'check your mail to activate your account $email';
                }
            }
         if(isset($_POST['submit'])){
            if(isset($_GET['token'])){
                $token =$_GET['token'];
            
           
            $newpassword = mysqli_real_escape_string($con,$_POST['password']);
            $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
// to make password encrypt
            $pass=password_hash($newpassword,PASSWORD_BCRYPT);
            $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

            //for generating random token
          

 
         //verifying the unique email
         
         if ($newpassword === $cpassword) {
            $pass = password_hash($newpassword, PASSWORD_BCRYPT);
            $updatequery = "UPDATE user_details SET Password='$pass' WHERE token='$token'";
            $iquery = mysqli_query($con, $updatequery);

            if ($iquery) {
                $_SESSION['msg'] = "Your Password has been updated";
                header('location:login.php');
                exit();
            } else {
                $_SESSION['passmsg'] = "Your Password is not updated";
                header('location:reset_password.php');
                exit();
            }
        } else {
            $_SESSION['passmsg'] = "Password not matching";
        }


         }
        }
        



        else{
             
         
        ?>

            <header>Change Your Password</header>
            <p>
            <?php 
if (isset($_SESSION['passmsg'])) {
    echo "<p class='bg-success text-white px-4'>{$_SESSION['msg']}</p>";
    unset($_SESSION['passmsg']); // unset the session message to clear it after displaying
}
?>

            </p>
            <form action="" method="POST">
                
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword" autocomplete="off" required>
                </div>


                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Change Password" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>