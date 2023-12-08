<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Account Recovery</title>
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
                $_SESSION['msg'] = "Check your email to Reset your password.$email";
                header('location:login.php');

                //return  'check your mail to activate your account $email';
                }
            }
         if(isset($_POST['submit'])){

            
            $email = mysqli_real_escape_string($con,$_POST['email']);
            
// to make password encrypt
            
            //for generating random token
          


 
         //verifying the unique email
         $emailquery ="select * from user_details where Email='$email'";
         $query=mysqli_query($con,$emailquery);
         $emailcount=mysqli_num_rows($query);
         if($emailcount){
            $userdata =mysqli_fetch_array($query);
            $token =$userdata['Token'];
            
                


                    
                    include('smtp/PHPMailerAutoload.php');
                    $subject="Password Reset";
                    $body="Hi, $username. Click Here to Reset your password
                    http://localhost/login/reset_password.php?token=$token ";

                    echo smtp_mailer($email,$subject,$body);
                    

            

                    } else{
                        echo "No Email found";
                    }
                   
            
          }
           
        
         



         
        



        else{
             
         
        ?>

            <header>Recover Your Account</header>
            
            <form action="" method="post">
                

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                


                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Sent Recovery Mail " required>
                </div></br>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>