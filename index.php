<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css"  >
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_POST['submit']))
                {
                    
                    include("php/config.php");
                    
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    
                    //retrieving the hashed password for the given email
                    $sql = "SELECT * FROM users WHERE Email = '$email'";
                    $sql_result = mysqli_query($con, $sql);
                    

                    if($sql_result)
                    {
                        if(mysqli_num_rows($sql_result) > 0)
                        {
                            $_row = mysqli_fetch_assoc($sql_result);
                            $hashed_password = $_row['Password'];
                            if(password_verify($password, $hashed_password))
                            {
                                //login
                                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password = '$hashed_password'") or die("Select Error!");
                                $row = mysqli_fetch_assoc($result);
                                if(is_array($row) && !empty($row))
                                    {
                                        $_SESSION['valid'] = $row['Email'];
                                        $_SESSION['username'] = $row['Username'];
                                        $_SESSION['age'] = $row['Age'];
                                        $_SESSION['id'] = $row['Id'];
                                    }
                                else
                                    {
                                        echo "<div class='message'>
                                                    <p>Wrong Username or Password</p>
                                                </div> <br>";
                                        echo "<a href='index.php'><button class='btn'>Go Back</button></a>";
                                    }
                                if(isset($_SESSION['valid']))
                                    {
                                        header("Location: home.php");
                                    } 

                            }
                            else
                            {
                                echo "Incorect Password";
                            }
                        }
                        else
                        {
                            echo "User not found";
                        }

                    }
                    else
                    {
                        echo "Error executing query";
                    }
                    
                } 
                else {

                
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password ">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>    
                </div>
            </form>
        </div>
        <?php
                    }
        ?>
    </div>
    
</body>
</html>