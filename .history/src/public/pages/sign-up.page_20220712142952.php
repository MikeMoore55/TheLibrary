<!-- this is the page for when new users want to create a account for TheLibrary -->

<!-- 
    >>> naming convention <<<

    - name-name === html, js, css
    - name_name === php, sql

-->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    session_start();
    
    // connect to db
    $conn = connect();

    if

    // Define variables and initialize with empty values
    $username = $password = $age = $user_type = "";

    //error handling
    $username_error = $password_error = $age_error = $user_type_error = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){

        //username

        //check that username requirements are met
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username.";
            $username = "";
            $_SESSION["error"] = TRUE;
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/',($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
            $username = "";
            $_SESSION["error"] = TRUE;
        } else {
            $username_error = "";
            $username = $_POST["username"];
            $_SESSION["error"] = FALSE;
        }

        //age

        //check that age requirements are met
        if (empty(trim($_POST["age"]))) {
            $age_error = "Please enter a password.";
            $age = "";
            $_SESSION["error"] = TRUE;
        } elseif ($_POST["age"] <= 10) {
            $age_error = "You must be at least 10 years old.";
            $age = "";
            $_SESSION["error"] = TRUE;
        } else {
            $age = $_POST["age"];
            $age_error = "";
            $_SESSION["error"] = FALSE;
        }

        //password
       
        //check that password requirments are met
        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password.";
            $password = "";
            $_SESSION["error"] = TRUE;
        } elseif (strlen(trim($_POST["password"])) <= 6) {
            $password_error = "Password must have at least 6 characters.";
            $password = "";
            $_SESSION["error"] = TRUE;
        } else {
            $password = trim($_POST["password"]);
            $password_error = "";
            $_SESSION["error"] = FALSE;
        }

        //user type

        //makes member user type default
        if ($_POST["userType"] === "librarian") {
            $user_type = "librarian";
            $username_error = "";
        }else{
            $user_type = "member";
            $username_error = "";
        }

       // insert the input values to database
        $sql .= "INSERT INTO user_info (username, user_age, user_password, user_type) VALUES ('$username', '$age', '$password', '$user_type')";
        
        // if successful, take to home page
        if ($conn->multi_query($sql) === TRUE) {
           $location = "home";
           header("location: signIn");
           $_SESSION["error"] = FALSE;
        }
        // if not, stay on current page 
        else {
           echo "error";        
        };
        
        //close connection
        $conn->close();
    } 

?>

<main>
    <form class="sign-up-form form-control"  method="POST">
        <h2>Sign Up</h2>

        <label for="username" class="form-label">
            Username:
        </label>
        <input id="username" type="text" class="form-control" name="username" placeholder="username">
        <div class="invalid-feedback">
            <?php echo $username_error?>
        </div>

        <label for="age" class="form-label">
            Age:
        </label>
        <input id="age" type="age" class="form-control" name="age">
        <div class="invalid-feedback">
            <?php echo $age_error?>
        </div>
        <label for="user-type" class="form-label">
            User Type:
        </label>
        <select id="user-type" class="form-select" aria-label="Default select example" name="userType">
            <option>member</option>
            <option>librarian</option>
        </select>
        <div class="invalid-feedback">
            <?php echo $userType_error?>
        </div>
        <label for="password" class="form-label">
            Password:
        </label>
        <input id="password" type="password" class="form-control" placeholder="*****" name="password">
        <div class="invalid-feedback">
            <?php echo $password_error?>
        </div>
        <br>
        <input id="sign-up" type="submit" class="btn btn-primary mb-3 btn-override" name="signUp" value="Sign Up">
        <p>Have an account? <a href="signIn">Sign up!</a></p>
        
    </form>
</main>