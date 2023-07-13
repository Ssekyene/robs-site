<?php
    session_start();

    include("php/config.php");
    if(!isset($_POST['valid']))
        {
            header("Location: index.php");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>

        <div class="right-links">
            <?php
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT * FROM users WHERE Id='$id'");

                while($result = mysqli_fetch_assoc($query))
                {
                    $result_uname = $result['Username'];
                    $result_email = $result['Email'];
                    $result_age = $result['Age'];
                    $result_id = $result['Id'];
                }
                echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?>
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b>Robert</b>, Welcome</p>
                </div>
                <div class="box">
                    <p>Your email is <b>robert@gmail.com</b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>And you are <b>20 years old</b>.</p>
                </div>
            </div>
        </div>
    </main>  
</body>
</html>