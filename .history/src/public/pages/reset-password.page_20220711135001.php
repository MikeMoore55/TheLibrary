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
    if (empty(trim($_POST["password"]))) {
        $password_error = "Please enter a password.";
        $password_input = "";
        $_SESSION["error"] = 1;
    } 
    elseif (strlen(trim($_POST["password"])) <= 6) {
        $password_error = "Password must have at least 6 characters.";
        $password_input = "";
        $_SESSION["error"] = 1;

    } 
    else {
        $password_input = trim($_POST["password"]);
        $password_error = "";
        $_SESSION["error"] = 0;

    }

    // find user info so we can reset password
    $sql = "SELECT * FROM user_info WHERE username = '$username_input';";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
             // create variables from db        
             $user_verified_name = $row["username"];// db username
             $user_verified_password = password_hash($row["user_password"], PASSWORD_DEFAULT);// db user password
             $user_verified_type = $row["user_type"];// db user type
        }

    } 
    else {
        echo "error...cant find on database";
    }
?>