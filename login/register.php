<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">






        <?php 
        include("php/config.php");
        if (isset($_POST['submit'])){
            $username =$_POST['Username'];
            $email =$_POST['Email'];
            $phoneno =$_POST['Phone_no'];
            $password =$_POST['Password'];


            //verifying the unique email
            $verify_query=mysqli_query($con,"SELECT Email from user_details WHERE Email='$email' ");
            
            if(mysqli_num_rows($verify_query)!=0){
                
               echo "<div class='message'>
                         <p> This email is already used</p>
                         </div><br>";
                         echo "<a href='javascript:history.back()'><button class='btn'>Go Back</button>";
            }
            else{
                $insert_query=mysqli_query($con,"INSERT INTO user_details (Username,Email,Phone_no,Password)VALUES('$username','$email','$phone_no','$password')") or die("Error Occurred");
                if($insert_query){
                echo "<div class='message'>
                <p> Registration Successfully!</p>
                </div><br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button></a>";
                }
                else{
                    echo "Error:".mysqli_error($con);
                }
                }
            }
        

        

        ?>

       


            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Username">Username</label>
                    <input type="text" name="Username" id="Username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="Email" name="Email" id="Email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Phone_no">phone no:</label>
                    <input type="tel" name="Phone_no" id="Phone_no" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Password">password</label>
                    <input type="password" name="Password" id="Password" autocomplete="off" required>
                </div>
                <div class="field">
                    
                    <input type="submit" name="submit" value="Register" class="btn" required>
                </div>
                <div class="links">
                    Already Have Account? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php  ?>
    </div>
    
</body>
</html>