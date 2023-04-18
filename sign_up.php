<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz - Sign Up</title>
        <meta name="description" content="Sign Up page">
        <style>
            input {
                border-radius: 20px;
                width: 200px;
                height: 20px;
            }

            select {
                border-radius: 20px;
                width: 200px;
                height: 50px;
            }
        </style>
        <script>
            // const usernamePattern = /^[a-zA-Z0-9]+$/;
            // var checkUsernaem = function() {
            //     if ()
            // }

            var pswValidation = function() {
                if (document.getElementById("pass1").value == 
                    document.getElementById("pass2").value) {
                    pass1.style.border = "3px solid green";
                    pass2.style.border = "3px solid green";
                    //document.getElementById('submit').disabled = false;
                } else {
                    pass1.style.border = "3px solid red";
                    pass2.style.border = "3px solid red";
                    //document.getElementById('submit').disabled = true;
                }
            }


        </script>
    </head>
    
    <body>
        <?php
            include('conn.php');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password_1'];
                $DOB = $_POST['DOB'];
                $Tel = $_POST['mobile_number'];

                $query = "INSERT INTO user (Username, Email, Password, DOB, Tel) VALUES ('$username', '$email', '$password', '$DOB', '$Tel')";

                if (mysqli_query($con, $query)){
                    echo "<script>alert('Your account had been created!');
                    window.location.href= 'login.php';</script>";
                }
                else {
                    echo "Failed to create account: ". mysqli_error($con);
                }
                mysqli_close($con);
            }
        ?>

        <form action="sign_up.php" method="POST" onsubmit='pswValidation()'>
            <table>
                <tr>    
                    <td>Username:</td>
                </tr>
                <tr>
                    <td><input type="text" name="username" pattern="[A-Za-z0-9]{1,25}" title="Only alphanumeric and not longer than 25 alphabet accepted."></td>
                </tr>
                <tr>    
                    <td>Email:</td>
                </tr>
                <tr>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                </tr>    
                <tr>
                    <td><input type="password" name="password_1" id="pass1" pattern="(?=.*\d).[A-Za-z0-9_@-]{6,}"></td>
                </tr>
                <tr>    
                <tr>
                    <td>Confirm Password:</td>
                </tr>    
                <tr>
                    <td><input type="password" name="password_2" id="pass2"></td>
                </tr>
                <tr>
				<td>Gender:</td>
                </tr>
                <tr>
                    <td>
                    <select name="gender">
                        <option value="">Please select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    </td>
                </tr>
                <tr> 
                    <td>Date Of Birth:</td>
                </tr>
                <tr>
                    <td><input type="date" name="DOB"></td>
                </tr>
                <tr>    
                    <td>Mobile Number:</td>
                </tr>
                <tr>
                    <td><input type="tel" name="mobile_number"></td>
                </tr>
                <tr>
                    <td><button name="submit" id="submit">Sign up</button></td>
                </tr>
                <tr></tr><tr></tr>
                <tr>
                    <td><p>Already have an account? <a href="login.php">Click here</a> to login.</p></td>
                </tr>
            </table>
        </form>
    </body>
</html> 