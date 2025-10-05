<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQLI TODO</title>
</head>
<body>
    <form action="TODO_DB_LOGIN.php" method="post">
        <h1>TODO LIST LOGIN</h1> <br> <br>
        <label>Username: </label>
        <input type="text" name="username"> <br>
        <label>Password:</label>
        <input type="password" name="password"> <br>
        <input type="submit" name="submit" value="Login"> <br>
        <input type="submit" name="signup" value="Go to Sign Up">
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

            $sql = "SELECT password FROM users WHERE user = '$username'";
            $result =  mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $pass = $row['password'];
            #var_dump($pass);
            if($password == $pass){
                echo "Logged IN";
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                header("Location: TODO.php");
                exit();
            }else{
                echo "Invalid Credentials";
            }
        
            /*
            try{
                mysqli_query($conn, $sql);
                echo "Registered!";
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                header("Location: TODO.php");
                exit();
            }catch(mysqli_sql_exception){
                echo "Username Already taken";
            }*/
        }
    }
    

    if(isset($_POST['signup'])){
        session_destroy();
        header("Location: TODO_DB_SIGNIN.php");
    }

    mysqli_close($conn);

?>