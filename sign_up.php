<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz - Sign Up</title>
        <meta name="description" content="Sign Up page">
    </head>
    
    <body>
        <form action="create_account.php" method="POST">
            <table>
                <tr>    
                    <td>Username:</td>
                </tr>
                <tr>
                    <td><input type="text" name="username"></td>
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
                    <td><input type="text" name="password_1"></td>
                </tr>
                <tr>    
                <tr>
                    <td>Confirm Password:</td>
                </tr>    
                <tr>
                    <td><input type="text" name="password_2"></td>
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
                    <td><button name="submit">Sign up</button></td>
                </tr>
                <tr></tr><tr></tr>
                <tr>
                    <td><p>Already have an account? <a href="login.php">Click here</a> to login.</p></td>
                </tr>
            </table>
        </form>
    </body>
</html> 