<?php
    include('../session.php');
    include("../conn.php");
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE ID = $id";
    $result = mysqli_query($con, $sql);
?>
<head>
    <title>KON Quiz - Edit profile</title>
</head>
<div class="toast align-items-center mx-auto border-0" id="alert1" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

<div class="container mx-auto">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Edit Profile</a>
        </li>
    </ul>
    <div class="shadow p-5 pt-4">
        <?php while($row = mysqli_fetch_array($result)) { ?>
        <form action="" method="POST" class="mt-2" id="edit-form" name="edit-profile" enctype="multipart/form-data">
            <div class="row">
                <input type="hidden" name="id" value='<?php echo $_SESSION['id'] ?>'>
                <!-- <div class="mx-auto">
                    <label for="" class="form-label">Profile Picture</label>
                        <input id="profile-pic" class="form-control" type="file" name="profile-pic">
                </div> -->
                <div class="col-md-5 mx-auto">
                    <label for="username" class="form-label">Username</label>
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
                <label for="" class="form-label">Old Password</label>
                <div class="input-group">
                    <input id="pass" class="form-control" type="password" name="password" disabled>
                    <div class="invalid-feedback">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="passCheck" name="old_password" onclick="enablePassword()">
                    <label class="form-check-label" for="passCheck">To change password, check the checkbox.</label>
                </div>
                
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="col-md mx-auto">
                <label for="" class="form-label">New Password</label>
                    <input id="pass1" class="form-control" type="password" name="password_1" disabled oninput="validatePw();validateCPw()">
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="col-md mx-auto">
                <label for="" class="form-label">Confirm New Password</label>
                    <input id="pass2" class="form-control" type="password" name="password_2" disabled oninput="validateCPw()">
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
                <input type="hidden" name="edit-profile" value="1">
                <button class="btn btn-primary" name="edit" style="width: 10vh;">
                    SAVE
                </button>
            </div>
        </form>
        <?php 
            };
            mysqli_close($con);
        ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#edit-form').submit(function(e) {
            e.preventDefault();
            var form_data = $(this).serializeArray();
            var form_data = new FormData($(this)[0]);
            const fileUpload = document.getElementById('profile-pic');
            // if (fileUpload.value) {
            //     var file = document.forms['edit-profile']['profile-pic'].files[0];
            //     const file_name = file.name;
            //     //form_data.push({name: "profile-pic", value: file_name})
            //     form_data.append('profile-pic', file_name);
            // }
            console.log(form_data);
            $.ajax({
                type: 'POST',
                url: 'update_profile.php',
                processData: false,
                contentType: false,
                data:  form_data,
                success: function(response) {
                    console.log("Test");
                    console.log("<?php echo $_SESSION['id']?>");
                    console.log('Response:', response);
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                        $('#alert1').removeClass('text-bg-danger').addClass('text-bg-success');
                    } else {
                        $('#alert1').removeClass('text-bg-success').addClass('text-bg-danger');
                        switch(data.type) {
                            case 0:
                                $('#username').removeClass('is-valid').addClass('is-invalid');
                                break;
                            case 1:
                                $('#email').removeClass('is-valid').addClass('is-invalid');
                                break;
                            case 2:
                                $('#pass').removeClass('is-valid').addClass('is-invalid');
                                break;
                            default:
                                break;
                        }
                        
                        // if(data.type == 0){
                        //     $('#username').removeClass('is-valid').addClass('is-invalid');
                        // }else if(data.type == 1){
                        //     $('#email').removeClass('is-valid').addClass('is-invalid');
                        // }else if(data.type == 2){
                        //     $('#pass').removeClass('is-valid').addClass('is-invalid');
                        // }
                        // else if(data.type == 3){
                        //     $('#pass').removeClass('is-valid').addClass('is-invalid');
                        // }
                    }
                    $('#alert1').find('.toast-body').html(data.message);
                    bootstrap.Toast.getOrCreateInstance(document.getElementById('alert1')).show();
                }
            });
        });
    });

    function enablePassword() {
        var checkbox = document.getElementById('passCheck');
        var passInput = document.getElementById('pass');
        var passInput1 = document.getElementById('pass1');
        var passInput2 = document.getElementById('pass2');


        if(checkbox.checked) {
            passInput.disabled = false;
            passInput1.disabled = false;
            passInput2.disabled = false;
        }
        else {
            passInput.disabled = true;
            passInput1.disabled = true;
            passInput2.disabled = true;
        }
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
        transition: all 0.2s ease-in-out;
    }
</style>