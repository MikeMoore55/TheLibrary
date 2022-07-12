<!-- page for user to reset password -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<?php
    session_start();
        
     /* check if any errors, if there is will display helpers under input boxes */
        if ($_SESSION["error"] = TRUE) {
        echo '  <script>
                        document.querySelector("#error").style.display = "block";
                        document.querySelector("#error").style.color = "red"
                    </script>';
    } 
    elseif ($_SESSION["error"] = FALSE){
         echo '  <script>
                    document.querySelector("#error").style.display = "none";
                </script>';
    }
    else{
        echo "error";
    }

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    //connect to db
    $conn = connect();
    
    $username_input = $new_password_input = "";
    $username_error = $password_error = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){

        // validate username
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username.";
            $username_input = "";
            $_SESSION["error"] = TRUE;
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/',($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
            $username_input = "";
            $_SESSION["error"] = TRUE;
        } 
        else {
            $username_error = "";
            $username_input = $_POST["username"];
            $_SESSION["error"] = FALSE;
        }

        // validate password
        if (empty(trim($_POST["new_password"]))) {
            $password_error = "Please enter a password.";
            $new_password_input = "";
            $_SESSION["error"] = TRUE;
        } 
        elseif (strlen(trim($_POST["new_password"])) <= 6) {
            $password_error = "Password must have at least 6 characters.";
            $new_password_input = "";
            $_SESSION["error"] = TRUE;

        } 
        else {
            $new_password_input = trim($_POST["new_password"]);
            $password_error = "";
            $_SESSION["error"] = FALSE;

        }

        // find user info so we can reset password
        $sql_1 = "SELECT * FROM user_info WHERE username = '$username_input';";

        $result = $conn->query($sql_1);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // create variables from db        
                $verified_username = $row["username"];// db username
                $old_user_password = $row["user_password"];// db old user password
            }

        } 
        else {
            echo "error...cant find on database";
        }

        if ($username_input === $verified_username && $new_password_input !== $old_user_password) {
            
            $sql_2 .= "UPDATE user_info SET user_password = '$new_password_input' WHERE username = '$username_input';";

            // if successful, take to home page
            if ($conn->multi_query($sql_2) === TRUE) {
                $location = "signIn";
                header("location: signIn") ;
                $_SESSION["error"] = FALSE;
            }
            // if not, stay on current page 
            else {
                echo "error";        
            }
        }
    }
?>

<main class="forgot-password">
<form class="reset-password-form" method="POST">
        <h2>Reset Password</h2>
        <label for="username" class="form-label">
            Username:
        </label>
        <input id="username" type="text" class="form-control" name="username">
        <div id="error" class="error">
            <?php echo $username_error;?>
        </div>
        <label for="password" class="form-label">
            New-Password:
        </label>
        <input id="password" type="password" class="form-control" placeholder="*****" name="new_password">
        <div id="error" class="error">
            <?php echo $password_error;?>
        </div>
        <br>
        <input id="sign-in" type="submit" class="btn btn-primary mb-3 btn-override" name="signIn" value="Sign In">
        <p><a href="signIn">Never Mind!</a></p>
    </form>
</main>