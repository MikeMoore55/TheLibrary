<!-- this is the page for when user whats to sign in to his/her library account -->

<main>
    <form class="sign-in-form form-control" action="home" method="POST">
        <h2>Sign In</h2>
        <label for="exampleFormControlInput1" class="form-label">
            Username:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username">
        <label for="exampleFormControlInput2" class="form-label">
            Password:
        </label>
        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="*****" name="password">
        <br>
        <input type="submit" class="btn btn-primary mb-3" name="signIn" value="Sign In">
        <p>Dont have an account?</p>
        <a href="/MAMP/htdocs/TheLibrary/src/pages/sign-up.page.php">Create One!</a>
    </form>
</main>