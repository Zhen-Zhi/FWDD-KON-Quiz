<?php include("template.html"); ?>
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
            $message = "";
            $credential = "";
            $password = "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $credential = mysqli_real_escape_string($con,$_POST['credential']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                
                $query = "SELECT id, username, email, password FROM user where username = '$credential' OR email = '$credential'";
                $result = mysqli_query($con, $query);
                $data = $result->fetch_assoc();

                if ($data == NULL) {
                    $message = "Error";
                }
                else if ($password == $data['password']) {
                    $message = "Success";
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    // echo "<script>setTimeout(function(){window.location.href='dummy.php';}, 2000);</script>";
                    // header("location:dummy.php");
                }
                else {
                    $message = "Error";
                    // echo "<script>alert('Username or password incorrect!')</script>";
                }

                mysqli_close($con);
            }
        ?>

        <!-- html start here -->
        <div class="card shadow border">
            <div class="card-header text-center">
                LOGIN
            </div>
            <div class="card-body">
                <form class="needs-validation" action="login.php" method="POST" novalidate>
                    <div class="col-md-6 mx-auto">
                        <label for="" class="form-label">Username or Email:</label>
                        <input id="credential" class="form-control <?php if ($message == "Error") echo 'is-invalid'; else if ($message == "Success")  echo 'is-valid'?>" value="<?php echo $credential;?>" type="text" name="credential">
                        <div class="invalid-feedback">
                            Incorrect username or email.
                        </div>
                    </div>
                    
                    <div class="col-md-6 mx-auto">
                        <label for="" class="form-label">Password:</label>
                        <input id="password" class="form-control <?php if ($message == "Error") echo 'is-invalid'; else if ($message == "Success") echo 'is-valid'?>" value="<?php echo $password;?>" type="password" name="password">
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                    </div>
                    
                    <div class="col-md-6 mt-2 mx-auto text-center">
                        <button class="btn btn-primary w-50" name="login">
                            <div <?php if ($message == "Success") echo 'hidden'; ?>>
                                LOGIN
                            </div>
                            <div class="spinner-border spinner-border-sm text-light" role="status" <?php if ($message == "Success") echo 'visible'; else echo 'hidden' ?>>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>

                    <div class="col-md-6 mt-2 mx-auto sign text-center">
                        <p>Don't have an account? <a href="sign_up.php">Click here</a> to sign up.</p>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>

<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        width: 100%;
    }

    .card-header{
        font-weight: bold;
        font-size: 20px;
    }

    .card{
        width: 30% !important;
        box-shadow: 1px solid black;
    }

    .sign{
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .card{
            width: 100% !important;
        }
    }

    @media (min-width: 768px) and (max-width: 1400px) {
        .card {
            width: 50% !important;
        }
    }
</style>