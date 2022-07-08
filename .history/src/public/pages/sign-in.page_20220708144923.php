<!-- this is the page for when user whats to sign in to his/her library account -->
<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    session_start();

    /* -- session variables -- */

    // is user signed in
    $_SESSION["is-signed-in"] === FALSE;
    // define default user type as member 
    $_SESSION["is_librarian"] == FALSE;
    // to get current username
    $_SESSION["user"] = "";
    // error counter
    $_SESSION["error"] = 0;

    $conn = connect();

    $username = $password = "";
    $username_error = $password_error = $signIn_error = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){

        // validate username
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username.";
            $usernameInput = "";
            $_SESSION["error"] = 1;
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/',($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
            $usernameInput = "";
            $_SESSION["error"] = 1;
        } 
        else {
            $username_error = "";
            $usernameInput = $_POST["username"];
            $_SESSION["error"] = 0;
        }


        // validate password
        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password.";
            $passwordInput = "";
            $_SESSION["error"] = 1;
        } 
        elseif (strlen(trim($_POST["password"])) <= 6) {
            $password_error = "Password must have at least 6 characters.";
            $passwordInput = "";
            $_SESSION["error"] = 1;

        } 
        else {
            $passwordInput = trim($_POST["password"]);
            $password_error = "";
            $_SESSION["error"] = 0;

        }


        // get row where username is = the username input
        $sql = "SELECT * FROM user_info WHERE username = '$usernameInput'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                // create variables from db        
                $user_verifiedName = $row["username"];// db username
                $user_verifiedPassword = password_hash($row["user_password"], PASSWORD_DEFAULT);// db user password
                $user_verifiedType = $row["user_type"];// db user type
            }

        } 
        else {
            echo "error...cant find on database";
        }

        // check is username and password matches
        if ($usernameInput === $user_verifiedName && password_verify($passwordInput, $user_verifiedPassword)) {
            echo "user identified, access granted!";
            $_SESSION["is-signed-in"] === TRUE;
            // if user librarian, send to "librarian page"
            if ($user_verifiedType === "librarian") {
                $_SESSION["is_librarian"] == TRUE;
                header("location: librarian") ; 
                $_SESSION["error"] = 0;

            }
            else{
                header("location: home") ;
                $_SESSION["error"] = 1;
                $signIn_error = "this username or password don't match, please try again";

            }
        }
        else{
            echo "error";
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