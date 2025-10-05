
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fakebook</title>
</head>
<body>

    <form action="index.php" method="post">
        <h2>Welcome to Fakebook</h2> <br>
        <label>Username: </label>
        <input type="text" name="username">
        <br>
        <label>Password: </label>
        <input type="password" name="password">
        <br>
        <input type="submit" name ="submit" value="Register">

    </form>
    
</body>
</html>

<?php 

    include("database.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($username) || empty($password)){
            echo "Please enter all the credentials";
        }else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(user, password) VALUES ('$username', '$hash')";
            try{
                mysqli_query($conn, $sql);
                echo "Registered!";
            }catch(mysqli_sql_exception){
                echo "Username already taken";
            }
        }
    }
     

mysqli_close($conn);

?>
