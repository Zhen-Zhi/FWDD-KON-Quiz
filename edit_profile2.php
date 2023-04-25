<?php
    include('session.php');
    include("conn.php");
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE ID = $id";
    $result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz - Edit profile</title>
    </head>

    <body>
        <br><br>
        <div class="container pt-5 px-5 mx-auto">
            <div class="shadow p-5">
            <?php while($row = mysqli_fetch_array($result)) { ?>
            <form action="" method="POST" class="needs-validation">
                <div class="row">
                    <div class="d-flex justify-content-between align-items-center mb-3"> 
                        <h4 class="text-right">Edit Profile</h4> 
                    </div> 
                    <div class="col-md-5 mx-auto">
                        <label for="" class="form-label">Username</label>
                        <input id="username" class="form-control" type="text" name="username" value="<?php echo $row['Username']?>" oninput="validateName()">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-md-7 mx-auto">
                        <label for="" class="form-label">Email</label>
                        <input id="email" class="form-control" type="text" name="email" required value="<?php echo $row['Email']?>" oninput="validateEmail()">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                </div>
                <div class="col-md mx-auto">
                    <label for="" class="form-label">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <input class="form-check-input mt-2 mx-2" type="checkbox" id="passCheck" onclick="enablePassword(this.checked)">
                        </div>
                        <input id="pass1" class="form-control" type="password" name="password_1" disabled oninput="validatePw()">
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="col-md mx-auto">
                    <label for="" class="form-label">Confirm Password</label>
                    <input id="pass2" class="form-control" type="password" name="password_2" oninput="validateCPw()">
                    <div class="invalid-feedback">
                        Passwords are not the same.
                    </div>
                </div>
                <div class="row">
                    <div class="col-md mx-auto">
                        <label for="" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender">
                            <option value="">Please select</option>
                            <option value="Male" <?php if($row['Gender'] == "Male") { ?> selected <?php } ?>>Male</option>
                            <option value="Female" <?php if($row['Gender'] == "Female") { ?> selected <?php } ?>>Female</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a gender.
                        </div>
                    </div>
                    <div class="col-md mx-auto">
                        <label for="" class="form-label">Date of Birth</label>
                        <input class="form-control" name="DOB" type="date" value="<?php echo $row['DOB']?>">
                        <div class="invalid-feedback">
                            Please select a date.
                        </div>
                    </div>
                </div>
                <div class="col-md mx-auto">
                    <label for="" class="form-label">Mobile Number</label>
                    <input class="form-control" name="mobile_number" type="tel" value="<?php echo $row['Tel']?>">
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="col-md-6 mt-2 mx-auto text-center pt-3">
                    <input type="hidden" name="signup" value="1">
                    <button class="btn w-50" name="signup" id="save-btn">
                        Save
                    </button>
                </div>
            </form>
            <?php 
                };
                mysqli_close($con);
            ?>
        </div>
        </div>
    </body>
    <?php include("footer.php")?>

    <script>
    function enablePassword(check) {
        check = !check;
        document.pass1.disable = check;
    }

    function validateCPw(){
        var pw1 = document.getElementById('pass1');
        var pw2 = document.getElementById('pass2');

        if(pw1.value != ""){
            if(pw2.value != ""){
                if(pw2.value != pw1.value){
                    $('#pass2').siblings('.invalid-feedback').text('Passwords do not match');
                    $('#pass2').removeClass('is-valid').addClass('is-invalid');
                }else{
                    $('#pass2').removeClass('is-invalid');
                }
            }else{
                $('#pass2').siblings('.invalid-feedback').text('This field is required');
                $('#pass2').addClass('is-invalid');
            }
        }
    }

    function validateName(){
        var username = document.getElementById('username');

        if(username.value == "") {
            $('#username').siblings('.invalid-feedback').text('This field is required');
            $('#username').removeClass('is-valid').addClass('is-invalid');
        }else{
            var namePattern = /^[A-Za-z0-9]{1,25}$/;
            if (!namePattern.test(username.value)) {
                $('#username').siblings('.invalid-feedback').html('*Only alphanumeric<br>*Less than 25 alphabet');
                $('#username').removeClass('is-valid').addClass('is-invalid');
            }else{
                $('#username').removeClass('is-invalid');
            }
        }
    }

    function validatePw(){
        var pw1 = document.getElementById('pass1');

        if(pw1.value == ""){
            $('#pass1').siblings('.invalid-feedback').text('This field is required');
            $('#pass1').removeClass('is-valid').addClass('is-invalid');
        }else{
            var pwPattern = /^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z0-9_@-]{6,}$/;
            if (!pwPattern.test(pw1.value)) {
                $('#pass1').siblings('.invalid-feedback').html('*At least one number, one letter, underscore, "@" symbol, or hyphen<br>*At least 6 characters long');
                $('#pass1').removeClass('is-valid').addClass('is-invalid');
            }else{
                $('#pass1').removeClass('is-invalid');
            }
        }
    }

    function validateEmail(){
        var email = document.getElementById('email');

        if(email.value == ""){
            $('#email').siblings('.invalid-feedback').text('This field is required');
            $('#email').removeClass('is-valid').addClass('is-invalid');
        }else{
            var emailRegex = /^\S+@\S+\.\S+$/;
            if (!emailRegex.test(email.value)) {
                $('#email').siblings('.invalid-feedback').text('Enter the correct email format');
                $('#email').removeClass('is-valid').addClass('is-invalid');
            }else{
                $('#email').removeClass('is-invalid');
            }
        }
    }
    </script>

    <style>
    .form-label{
        font-weight: bold;
    }

    .form-control{
        margin-bottom: 0.5rem;
    }
    
    .form-control, .form-select{
        background-color: rgb(239, 237, 242) !important;
    }

    #save-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    }

    #save-btn:hover{
        background-color: #7e42f5 !important;
        border-bottom: 5px solid #1c0052;
        color: white;
    }

    #save-btn-close:focus{
        box-shadow: none;  
    }
    </style>
</html>