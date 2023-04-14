<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz - Login</title>
        <meta name="description" content="Login Page">
    </head>
    
    <body>
        <?php
            include("conn.php");
            session_start();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $credential = mysqli_real_escape_string($con,$_POST['credential']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                
                $query = "SELECT id, username, email, password FROM user where username = '$credential' OR email = '$credential'";
                $result = mysqli_query($con, $query);
                $data = $result->fetch_assoc();

                if ($data == NULL) {
                    echo "<script>alert('Username or password incorrect!')</script>";
                    //return;
                }
                else if ($password == $data['password']) {
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    header("location:dummy.php");
                }
                else {
                    echo "<script>alert('Username or password incorrect!')</script>";
                }
                mysqli_close($con);
            }
        ?>

        <!-- html start here -->
        <form action="login.php" method="POST">
            <table>
                <tr>    
                    <td>Username or Email:</td>
                </tr>
                <tr>
                    <td><input type="text" name="credential"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                </tr>    
                <tr>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td><button name="login">Login</button></td>
                </tr>
                <tr></tr><tr></tr>
                <tr>
                    <td><p>Don't have an account? <a href="sign_up.php">Click here</a> to sign up.</p></td>
                </tr>
            </table>
        </form>
    </body>
</html>