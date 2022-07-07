<!-- this is the page for when user whats to sign in to his/her library account -->

<main>
    <form class="sign-in-form form-control" action="home" method="POST">
        <h2>Sign In </h2>
        <label for="exampleFormControlInput1" class="form-label">
            Username:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username">
        <div class="invalid-feedback">
            Please fill in your username
        </div>
        <label for="exampleFormControlInput2" class="form-label">
            User Type:
        </label>
        <div class="invalid-feedback">
            Please select user type.
        </div>
        <select class="form-select" aria-label="Default select example" name="userType">
            <option>member</option>
            <option>librarian</option>
        </select>
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