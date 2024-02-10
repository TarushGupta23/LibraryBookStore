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
        header("Location: ./index.html");
    }
} else if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT password FROM admin WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $sql = "insert into admin values('$username','$password')";
        $result = $conn->query($sql);
        header("Location: ./index.html");
    } else {
        $_SESSION['message'] = "User already exists";
    }
}
?>

<form action="login.php" method="post">
    <input type="text" name="username" placeholder='username' required id='input-username' class='input-field'>
    <input type="password" name="password" placeholder='username' required id='input-password' class='input-field'>

    <input type="submit" value="Login" name="login" class='input-button'>
    <input type="submit" value="Create new Admin" name="signup" class='input-button'>
    <span class="error-msg">
    <?php 
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    ?>
    </span>
</form>