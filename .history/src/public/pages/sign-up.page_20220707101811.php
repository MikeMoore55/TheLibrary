<!-- this is the page for when new users want to create a account for TheLibrary -->

<?php
    require_once "/MAMP/htdocs/TheLibrary/config/database.config.php";

    // Define variables and initialize with empty values
    $username = $password = $age = $userType = "";

    //error handling
    $username_error = $password_error = $age_error = $userType_error = "";

    //determine the location
    $location = "";


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
        <p>Have an account? <a href="signIn">Sign In!</a></p>
        
    </form>
</main>