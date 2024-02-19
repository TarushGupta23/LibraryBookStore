<?php 
session_start();
include './partials/connection.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT password FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $_SESSION['message'] = "Invalid username or password";
    } else {
        $_SESSION['admin'] = "true";
        header("Location: ./adminPanel.php");
    }
// } else if (isset($_POST['signup'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
    
//     $sql = "SELECT password FROM admin WHERE username = '$username'";
//     $result = $conn->query($sql);
//     if ($result->num_rows == 0) {
//         $sql = "insert into admin values('$username','$password')";
//         $result = $conn->query($sql);
//         $_SESSION['admin'] = "true";
//         header("Location: ./adminPanel.php");
//     } else {
//         $_SESSION['message'] = "User already exists";
//     }
}
?>
<link rel="stylesheet" href="style/login.css">
<div class="container">
    <form action="login.php" method="post">
        <h2>Login Page</h2>
        <input type="text" name="username" placeholder='username' required id='input-username' class='input-field'>
        <input type="password" name="password" placeholder='passsword' required id='input-password' class='input-field'>
        <span class="error-msg">
        <?php 
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>
        </span>
        <div class="btns">
            <input type="submit" value="Login" name="login" class='input-button'>
            <!-- <input type="submit" value="New Admin" name="signup" class='input-button'> -->
        </div>
    </form>
</div>