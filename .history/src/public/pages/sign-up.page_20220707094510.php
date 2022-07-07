<!-- this is the page for when new users want to create a account for TheLibrary -->

<?php
    require "/MAMP/htdocs/TheLibrary/config/database.config.php";

    // Define variables and initialize with empty values
    $username = $password = $age = $userType = "";
    $username_error = $password_error = $age_error = $userType_error = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_error = "Username can only contain letters, numbers, and underscores.";
        } else {
            // Prepare a select statement
            $sql = "SELECT * FROM user_info WHERE username = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
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
            }
        }

        // Validate age
        if (empty(trim($_POST["age"]))) {
            $age_error = "Please enter your age.";
        } elseif (trim($_POST["password"]) < 10)  {
            $age_error = "You must be older than 10 to use TheLibrary.";
        } else {
            $password = trim($_POST["password"]);
        }

         // Validate age
        if (empty(trim($_POST["userType"]))) {
            $userType_error = "Please select a user type.";
        } else {
            $userType = trim($_POST["userType"]);
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_error = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Check input errors before inserting in database
        if (empty($username_error) && empty($password_error) && empty($age_error) && empty($userType_error)) {

            // Prepare an insert statement
            $sql = "INSERT INTO user_info (username, user_age, user_password, user_type) VALUES (?, ?, ?, ?)";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_age, $param_password, $param_userType);

                // Set parameters
                $param_username = $username;
                $param_age = $age;
                $param_userType = $userType;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: /TheLibrary/src/public/pages/login.page.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($conn);
    }
?>

<main>
    <form class="sign-up-form form-control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
        <p>Have an account? <a href="signIn">Sign In!</a></p>
        
    </form>
</main>