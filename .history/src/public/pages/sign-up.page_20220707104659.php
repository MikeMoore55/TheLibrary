<!-- this is the page for when new users want to create a account for TheLibrary -->

<?php
    include "/MAMP/htdocs/TheLibrary/config/database.config.php";

    // Define variables and initialize with empty values
    $username = $password = $age = $userType = "";

    //error handling
    $username_error = $password_error = $age_error = $userType_error = "";

    //determine the location
    $location = "";

    if(isset($_POST['signUp'])){
        //username
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter a username.";
        } 
        elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
        } else {
            // Prepare a select statement
            $sqlName = "SELECT id FROM users WHERE username = ?";
    
            if ($stmt = mysqli_prepare($conn, $sqlName)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
    
                // Set parameters
                $param_username = trim($_POST["username"]);
    
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);
    
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_error = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
                $username_error = "";
            }
        }

        //age
        if (empty(trim($_POST["age"]))) {
            $age_error = "Please enter a password.";
        } elseif (trim($_POST["age"]) < 10) {
            $age_error = "You must be at least 10 years old.";
        } else {
            $age = trim($_POST["age"]);
            $age_error = "";
        }

        //password
       
        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_error = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
            $password_error = "";
        }

        //user type

        if ($_POST["userType"] === "librarian") {
            $userType = "librarian";
            $username_error = "";
        }else{
            $userType = "member";
            $username_error = "";
        }

        if($username_error == "" && $age_error == "" && $password_error == "" && $userType_error == ""){
            $sql = "INSERT INTO user_info (username, user_age, user_password, user_type) VALUES ($username, $age, $password, $userType)";
            $location = "home";
            mysqli_close($conn);
        }else {
            echo "error, try again";
            $location = "signUp";
        };
    
    }


?>

<main>
    <form class="sign-up-form form-control" action="<?php $location ?>" method="POST">
        <h2>Sign Up</h2>

        <label for="exampleFormControlInput1" class="form-label">
            Username:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="username">
        <div class="invalid-feedback">
            <?php echo $username_error?>
        </div>

        <label for="exampleFormControlInput1" class="form-label">
            Age:
        </label>
        <input type="age" class="form-control" id="exampleFormControlInput1" name="age">
        <div class="invalid-feedback">
        <?php echo $age_error?>
        </div>
        <label for="exampleFormControlInput2" class="form-label">
            User Type:
        </label>
        <div class="invalid-feedback">
        <?php echo $userType_error?>
        </div>
        <select class="form-select" aria-label="Default select example" name="userType">
            <option>member</option>
            <option>librarian</option>
        </select>
        <label for="exampleFormControlInput2" class="form-label">
            Password:
        </label>
        <div class="invalid-feedback">
            <?php echo $password_error?>
        </div>
        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="*****" name="password">

        <br>
        <input type="submit" class="btn btn-primary mb-3 btn-override" name="signUp" value="Sign Up">
        <p>Have an account? <a href="signIn">Sign up!</a></p>
        
    </form>
</main>