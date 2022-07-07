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
            $usernameInput = "";
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/',($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
            $usernameInput = "";
        } else {
            $username_error = "";
            $usernameInput = $_POST["username"];   
        }

        //password

        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password.";
            $passwordInput = "";
        } elseif (strlen(trim($_POST["password"])) <= 6) {
            $password_error = "Password must have at least 6 characters.";
            $passwordInput = "";
        } else {
            $passwordInput = trim($_POST["password"]);
            $password_error = "";
        }

        $sql .= "SELECT * FROM user_info WHERE username = $usernameInput";

        $result = $conn->query($sql);

        if ($result->num_rows == true) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["user_id"]. " - Name: " . $row["username"]. " " . $row["user_password"]. "<br>";
        }
        } else {
        echo "0 results <br> $password <br> $username";
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