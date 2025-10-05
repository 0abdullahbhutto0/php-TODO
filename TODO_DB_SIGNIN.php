<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLI TODO</title>
</head>
<body>
    <form action="TODO_DB_SIGNIN.php" method="post">
        <h1>TODO LIST SIGN UP</h1> <br> <br>
        <label>Username: </label>
        <input type="text" name="username"> <br>
        <label>Password:</label>
        <input type="password" name="password"> <br>
        <input type="submit" name="submit" value="Sign In"> <br>
        <input type="submit" name="login" value="Go to Login">
    </form>
</body>
</html>

<?php
    session_start();
    include("database.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $username = $_POST['username'];
        $password = $_POST['password'];
        if(empty($username)||empty($password)){
            echo "Please enter all the credentials";
        }else{
            $sql = "INSERT INTO users(user, password) VALUES('$username', '$password')";
            try{
                mysqli_query($conn, $sql);
                echo "Registered!";
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                header("Location: TODO.php");
                exit();
            }catch(mysqli_sql_exception){
                echo "Username Already taken";
            }
        }
    }

    if(isset($_POST['login'])){
        session_destroy();
        header("Location: TODO_DB_LOGIN.php");
    }

    mysqli_close($conn);

?>