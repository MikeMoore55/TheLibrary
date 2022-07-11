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