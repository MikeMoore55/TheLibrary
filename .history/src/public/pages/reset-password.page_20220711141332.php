<!-- page for user to reset password -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<?php
    session_start();

    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    //connect to db
    $conn = connect();
    
    if($_SERVER["REQUEST_METHOD"]== "POST"){

        // validate username
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username.";
            $username_input = "";
            $_SESSION["error"] = 1;
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/',($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
            $username_input = "";
            $_SESSION["error"] = 1;
        } 
        else {
            $username_error = "";
            $username_input = $_POST["username"];
            $_SESSION["error"] = 0;
        }

        // validate password
        if (empty(trim($_POST["new_password"]))) {
            $password_error = "Please enter a password.";
            $new_password_input = "";
            $_SESSION["error"] = 1;
        } 
        elseif (strlen(trim($_POST["new_password"])) <= 6) {
            $password_error = "Password must have at least 6 characters.";
            $new_password_input = "";
            $_SESSION["error"] = 1;

        } 
        else {
            $new_password_input = trim($_POST["new_password"]);
            $password_error = "";
            $_SESSION["error"] = 0;

        }

        // find user info so we can reset password
        $sql_1 = "SELECT * FROM user_info WHERE username = '$username_input';";

        $result = $conn->query($sql_1);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // create variables from db        
                $verified_username = $row["username"];// db username
                $old_user_password = password_hash($row["user_password"], PASSWORD_DEFAULT);// db old user password
            }

        } 
        else {
            echo "error...cant find on database";
        }

        if ($username_input === $verified_username && $new_password_input != $old_user_password) {
            
            $sql_2 .= "UPDATE user_info SET user_password = '$new_password_input' WHERE username = '$username_input';";

            // if successful, take to home page
            if ($conn->multi_query($sql_2) === TRUE) {
                $location = "signIn";
                header("location: signIn") ;
            }
            // if not, stay on current page 
            else {
                echo "error";        
            };
        }
    }
?>

<main>
<form class="reset-password-form form-control" method="POST">
        <h2>Reset Password</h2>
        <label for="username" class="form-label">
            Username:
        </label>
        <input id="username" type="text" class="form-control" name="username">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="password" class="form-label">
            New-Password:
        </label>
        <input id="password" type="password" class="form-control" placeholder="*****" name="password">
        <div class="invalid-feedback">
            Please fill in your password.
        </div>
        <br>
        <input id="sign-in" type="submit" class="btn btn-primary mb-3 btn-override" name="signIn" value="Sign In">
        <p><a href="signIn">Never Mind!</a></p>
    </form>
</main>