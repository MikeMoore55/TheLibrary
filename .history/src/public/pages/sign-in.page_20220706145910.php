<!-- this is the page for when user whats to sign in to his/her library account -->

<main>
    <form class="sign-in-form" action="home" method="POST">
        <label for="exampleFormControlInput1" class="form-label">
            Username:
        </label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="username">
        <label for="exampleFormControlInput2" class="form-label">
            Password:
        </label>
        <input type="password" class="form-control" id="exampleFormControlInput2" placeholder="*****" name="password">
        <input type="submit" name="signIn" value="Sign In"
    </form>
</main>