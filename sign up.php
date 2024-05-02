<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title> Sign Up </title>
        <link rel="stylesheet" href="sign up.css">
    </head>
    <body>
        <div id = "container">
            <form action = "" method = "post" id = "login-form">
                <div class = "credentials">
                    <h3> Create an account </h3>
                    <p class = "name">
                        <Label for = "name"> Full name </Label>
                        <input type = "text" name = "name" id = "name" placeholder = "Enter your second name" required autocomplete>
                    </p>
                    <p class = "email">
                        <Label for = "email"> Email </Label>
                        <input type = "email" name = "email" id = "email" placeholder = "Enter your email" required autocomplete>
                    </p>
                    <p class = "password">
                        <Label for = "pass"> Password </Label>
                        <input type = "password" name = "pass" id = "pass" placeholder = "Enter password" required>
                    </p>
                    <p class = "confirm-password">
                        <Label for = "pass"> Confirm password </Label>
                        <input type = "password" name = "cpass" id = "pass" placeholder = "confirm password" required>
                    </p>
                    <button type = "submit" name = "create_account"> Create account </button>
                    <p> already have an account? <a href = "index.php"> sign in  </a></p>
                </div>
            </form>
        </div>


        <?php
            /* importing the dbconnect document that was created so that I will be able to link this code to the database */

            include_once("../dbconnect.php");

            /*-----------Done including the dbconnect document---------------*/

            /* Storing the name, email, cpass, and pass in variables so we can later transfer them to the database*/

            if (isset($_POST["create_account"]))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $pass = sha1(($_POST['pass']));
                $cpass = sha1(($_POST['cpass']));

            /* Done accepting all the data that will be used in the input fields of the form */

            /* Checking the whole database to see if the username has ever been used before */

                $sql = "SELECT * FROM create_account where Name = '$name'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($result))
                {
                    echo 'This name has already been used';
                }

            /* Done checking, but the else part is also included */
            
                else
                {
                    /* Checking if the password is equal to the confirm password before creating account successfully */

                    if($pass === $cpass)
                    {
                        /* Transferring the data accepted from the various variables above and transferring it to the database */

                        $sql = "INSERT INTO `create_account` (Name, Email, Password) VALUES ('$name', '$email', '$pass')";
                        $result = mysqli_query($conn, $sql);
                        if ($result)
                        {
                            echo "Account created successfully";
                        }
                        else
                        {
                            die ("Problem inserting into the database table".mysqli_errno($conn));
                        }

                        /* Done inserting into the database table */

                    }
                    else
                    {
                        echo 'Password could not be authenticated';
                    }
                    /*----Done checking if the password is the same as the confirmed password----*/
                }
            }
        ?>


    </body>
</html>