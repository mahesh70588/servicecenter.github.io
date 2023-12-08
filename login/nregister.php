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
         if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($con,$_POST['username']);
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $phone = mysqli_real_escape_string($con,$_POST['phone']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
// to make password encrypt
            $pass=password_hash($password,PASSWORD_BCRYPT);
            $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

            //for generating random token
            $token=bin2hex(random_bytes(15));


 
         //verifying the unique email
         $emailquery ="select * from user_details where Email='$email'";
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
                $insertquery="insert into user_details (Username,Email,Phone,Password,Cpassword,Token,Status) VALUES('$username','$email','$phone','$pass','$cpass','$token','inactive')";
                $iquery=mysqli_query($con,$insertquery);
                if($iquery){
                    //new mthod for verification
?><?php
                    
                    include('smtp/PHPMailerAutoload.php');
                    
                    echo smtp_mailer('maheshsh.0045@gmail.com','test2 Subject','hello vishal');
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
                            return 'Sent';
                        }
                    }
                    ?>
                    









<?php


/*


                    //through email authentication to activate account
                    $subject="Account Activation";
                    $body="Hi, $username. Click Here to activate your account 
                    http://localhost/login/login.php?token=$token ";
                    $sender_email="From: maheshsh.0045@gmail.com";
                    if(mail($email,$subject,$body,$sender_email)){
                        /*
                        echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
                  echo "<a href='login.php'><button class='btn'>Login Now</button>";
                  */
                        //echo "email sent successfully";
                       
                        
                      //  $_SESSION['msg']="check your mail to activate your account $email";
                       // header('location:login.php');
                    }
                   // else{
                       // echo "Email sending failed...";
                   // }


                     
                    /*
                    // to show successful message after registration
                    echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
                  echo "<a href='login.php'><button class='btn'>Login Now</button>";
                  */

              //  } 
            //}
            //else{
           //     echo "<div class='message'>
         //   <p>Password and Confirm Password Doesn't match!</p>
       // </div>
          //<br>";
          //echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";

           // }
            
          }
           
        
         

/*
         $verify_query = mysqli_query($con,"SELECT Email FROM user_date WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
        
          
         
         else{

            mysqli_query($con,"INSERT INTO user_date (Username,Email,Phone,Password) VALUES('$username','$email','$phone','$pass','$cpass','$Token','$Status')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn'>Login Now</button>";
         

         }
         */

         }
        }



        else{
             
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="phone">Phone No</label>
                    <input type="text" name="phone" id="phone" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Confirm Password</label>
                    <input type="text" name="cpassword" id="cpassword" autocomplete="off" required>
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