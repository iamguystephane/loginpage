<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign in </title>
    <link rel="stylesheet" href = "sign in.css">
    <script src = "./JS/app.js" defer ></script>
</head>
<body>
    <form action = "" method = "post" id = "login-form">
        <div id = "container">
            <section class = "left-section">
                <h2> Sign in </h2>
                <input class = "email name" type = "text" id = "mail" name = "mail" placeholder = "gstephane138@gmail.com" required autocomplete>
                <p class = "password-form">
                    <input class = "password  name" type = "password" name = "password" id = "password" required placeholder = "password"> 
                    <i class = "fa-solid fa-eye" id = "show-password"></i>
                </p>
                <p class = "sign in">
                    <button class = "sign-in-btn" name = "signin"> sign in </button>
                </p>
                <p class = "forgot-password"><a href = "forgot password.html"> Forgot password? </a></p>
                <p class = "sign-in-with"> or sign in with </p>
                <div class = "sign-in-options">
                    <ul class = "links">
                        <li><a href = "https://www.twitter.com/login"><i class = "fab fa-twitter icons"></i></a></li>
                        <li><a href = "https://www.LinkedIn.com/login"><i class = "fab fa-linkedin-in icons"></i></a></li>
                        <li><a href = "https://www.facebook.com/login"><i class = "fab fa-facebook-f icons"></i></a></li>
                    </ul>
                </div>
            </section>
            <section class = "welcome-back">
                <h3> Welcome back!</h3>
                <p class = "text">
                    We are so happy to have you here. It's great to see you again. We hope you had a safe and enjoyable time away.
                </p>
                <button class = "sign-up-btn"><a href = "sign up.php"> No account yet? Sign up </a></button>
            </section>
        </div>
        <script src = "../JS/all.js"></script>
        <script src = "../JS/app.js"></script>
    </form>

    <?php
      if (isset($_POST['signin']))
      {
        include_once("../testdbconnect.php");
        $mail = ($_POST['mail']);
        $password = sha1($_POST['password']);
        $sql = "SELECT * FROM create_account WHERE Email = '$mail'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result))
        {
            $sqli = "SELECT * FROM create_account WHERE Password = '$password'";
            $result = mysqli_query($conn, $sqli);
            if($record = mysqli_fetch_assoc($result))
            {
                $sql = "INSERT INTO login_table (Email, Password) VALUES ('$mail', '$password')";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    echo 'Log in successful';
                    echo '<br>';
                    echo 'Data recorded to database';
                }
                else
                {
                    echo 'Login failed';
                }
            }
            else
            {
                echo 'Incorrect password';
            }
        }
        else
        {
            echo 'Email not found';
        }
      }
    ?>
</body>
</html>