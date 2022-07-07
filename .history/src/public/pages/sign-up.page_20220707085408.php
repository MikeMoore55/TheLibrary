<!-- this is the page for when new users want to create a account for TheLibrary -->

<main>
    <form class="sign-up-form form-control" action="home" method="POST">
        <h2>Sign Up</h2>
        <label for="exampleFormControlInput1" class="form-label">
            Username:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username" placeholder="username">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="exampleFormControlInput1" class="form-label">
            Age:
        </label>
        <input type="age" class="form-control" id="exampleFormControlInput1" name="age">
        <div class="invalid-feedback">
            Please fill in your Age
        </div>
        <label for="exampleFormControlInput2" class="form-label">
            Password:
        </label>
        <div class="invalid-feedback">
            Please fill in your password.
        </div>
        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="*****" name="password">
        <br>
        <input type="submit" class="btn btn-primary mb-3 btn-override" name="signUp" value="Sign Up">
        <p>Have an account? <a href="signIn">Sign In!</a></p>
        
    </form>
</main>