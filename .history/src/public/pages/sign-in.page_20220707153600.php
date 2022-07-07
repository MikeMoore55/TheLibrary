<!-- this is the page for when user whats to sign in to his/her library account -->
<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";
    session_start();
 
    $conn = connect();

    $username = $password = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){
        //username
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username.";
            $username = "";
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/',($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
            $username = "";
        } else {
            $username_error = "";
            $username = $_POST["username"];   
        }

        //password

        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password.";
            $password = "";
        } elseif (strlen(trim($_POST["password"])) <= 6) {
            $password_error = "Password must have at least 6 characters.";
            $password = "";
        } else {
            $password = trim($_POST["password"]);
            $password_error = "";
        }

        $sql = "SELECT username, user_password FROM user_info WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) === true) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if ($password == "") {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;

                            echo "success";

                            // Redirect user to welcome page
                            header("location: home");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_error = "Invalid username or password.";

                            echo "error";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_error = "Invalid username or password.";
                    echo "wrong credentials";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

?>

<main>
    <form class="sign-in-form form-control" method="POST">
        <h2>Sign In </h2>
        <label for="exampleFormControlInput1" class="form-label">
            Username:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="exampleFormControlInput2" class="form-label">
            Password:
        </label>
        <div class="invalid-feedback">
            Please fill in your password.
        </div>
        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="*****" name="password">
        <br>
        <input type="submit" class="btn btn-primary mb-3 btn-override" name="signIn" value="Sign In">
        <p>Don't have an account? <a href="signUp">Create One!</a></p>
        
    </form>
</main>