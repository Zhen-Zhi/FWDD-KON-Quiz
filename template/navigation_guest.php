<?php 
    include("template.html"); 
    include("toast.php");
?>
<nav class="navbar fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../homepage.php">
            KON-QUIZ
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item nav-bar">
                <button class="nav-link text-light" id="login-btn" type="button" data-bs-toggle="modal" data-bs-target="#login">LOGIN</button>
            </li>
            <li class="nav-item">
                <button class="nav-link text-light" id="signup-btn" type="button" data-bs-toggle="modal" data-bs-target="#signup">SIGN UP</button>
            </li>
        </ul>
    </div>
    
</nav>

<!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img" src="/FWDD-KON-QUIZ/img/wiz.png" alt="">
        <div class="modal-content">
            <div class="modal-header shadow">
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">LOGIN</h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast align-items-center mx-auto border-0" id="alert" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="" method="POST" novalidate id="login-form">
                    <div class="col-md-6 mx-auto">
                        <label for="" class="form-label">Username or Email</label>
                        <input id="credential" class="form-control" type="text" name="credential">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mx-auto">
                        <label for="" class="form-label">Password</label>
                        <input id="password" class="form-control" type="password" name="password">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    
                    <div class="col-md-6 mt-2 mx-auto text-center pt-1">
                        <input type="hidden" name="login" value="1">
                        <button class="btn btn-secondary w-50" type="submit" name="login">
                            <div id="login-text">
                                LOGIN
                            </div>
                            <div class="spinner-border spinner-border-sm text-light" id="spinner" role="status" hidden disabled>
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>

                    <div class="col-md-6 mt-2 mx-auto sign text-center">
                        <p>Don't have an account? <a data-bs-toggle="modal" data-bs-target="#signup" href="#">Click here</a> to sign up.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog flex-column modal-dialog-centered">
        <img class="modal-img" src="/FWDD-KON-QUIZ/img/wiz.png" alt="">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="toast align-items-center mx-auto border-0" id="alert1" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form action="" method="POST" novalidate id="signup-form">
                    <div class="row">
                        <div class="col-md-5 mx-auto">
                            <label for="" class="form-label">Username</label>
                            <input id="username" class="form-control" type="text" name="username" oninput="validateName()">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        <div class="col-md-7 mx-auto">
                            <label for="" class="form-label">Email</label>
                            <input id="email" class="form-control" type="text" name="email" required oninput="validateEmail()">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md mx-auto">
                        <label for="" class="form-label">Password</label>
                        <input id="pass1" class="form-control" type="password" name="password_1" oninput="validatePw();validateCPw()">
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
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a gender.
                            </div>
                        </div>
                        <div class="col-md mx-auto">
                            <label for="" class="form-label">Date of Birth</label>
                            <input class="form-control" name="DOB" type="date">
                            <div class="invalid-feedback">
                                Please select a date.
                            </div>
                        </div>
                    </div>
                    <div class="col-md mx-auto">
                        <label for="" class="form-label">Mobile Number</label>
                        <input class="form-control" name="mobile_number" type="tel">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2 mx-auto text-center pt-1">
                        <input type="hidden" name="signup" value="1">
                        <button class="btn btn-secondary" name="signup">
                            SIGNUP
                        </button>
                    </div>

                    <div class="col-md-6 mt-2 mx-auto sign text-center">
                        <p>Already had an account? <a data-bs-toggle="modal" data-bs-target="#login" href="#">Click here</a> to login.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log(formData)
            $.ajax({
                type: 'POST',
                url: '/FWDD-KON-QUIZ/auth.php',
                data: formData,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                        $('#credential').removeClass('is-invalid');
                        $('#password').removeClass('is-invalid');
                        document.getElementById('login-text').hidden = true;
                        document.getElementById('spinner').hidden = false;

                        setTimeout(function() {
                            window.location.href = '/FWDD-KON-QUIZ/homepage.php';
                        }, 2000);
                    } else {
                        $('#liveToast').addClass('text-bg-danger');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                        $('#credential').removeClass('is-valid').addClass('is-invalid');
                        $('#password').removeClass('is-valid').addClass('is-invalid');
                    }
                }
            });
        });

        $('#signup-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            var pass = true;

            if($('#signup-form .is-invalid').length){
                pass = false;
            }

            if(pass)
                $.ajax({
                    type: 'POST',
                    url: '/FWDD-KON-QUIZ/auth.php',
                    data: formData,
                    success: function(response) {
                        console.log(12322,response)
                        var data = JSON.parse(response);
                        console.log(123,data)
                        if (data.response == 'Success') {
                            window.location.href = '/FWDD-KON-QUIZ/homepage.php?&message=' + encodeURIComponent(data.message);
                        } else {
                            $('#liveToast').addClass('text-bg-danger');
                            $('#liveToast').find('.toast-body').html(data.message);
                            toastBootstrap.show();
                            if(data.type == 0){
                                $('#username').removeClass('is-valid').addClass('is-invalid');
                            }else if(data.type == 1){
                                $('#email').removeClass('is-valid').addClass('is-invalid');
                            }else if(data.type == 2){
                                $('#pass1').removeClass('is-valid').addClass('is-invalid');
                            }
                        }
                    }
                });
        });

        $('#signup-btn').on('click', function() {
            $(this).addClass('active');
        });

        $('#login-btn').on('click', function() {
            $(this).addClass('active');
        });
    });

    function toggleActiveClass(modal,btn){
        let selectedModal = document.getElementById(modal);
        let selectedBtn = document.getElementById(btn);

        selectedModal.addEventListener('hidden.bs.modal', function () {
            selectedBtn.classList.remove('active');
        });
    }
    toggleActiveClass('signup','signup-btn');
    toggleActiveClass('login','login-btn');

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
    body{
        padding-top: 8vh;
    }

    .navbar{
        background-color: #1c0052 !important;
    }

    .modal-header{
        font-weight: bold;
        font-size: 20px;
        background-color: #6E2BF2;
        color: white;
    }

    .modal-img{
        width: 25vh;
    }

    .nav-btn{
        background-color: #6E2BF2 !important;
        color: white !important;
    }

    .nav-bar .nav-link.active{
        background-color: #6E2BF2 !important;
        color: white !important;
    }

    /* .btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    }

    .btn:hover{
        background-color: #7e42f5 !important;
        border-bottom: 5px solid #1c0052;
        color: white;
    } */

    .btn-close:focus{
        box-shadow: none;  
    }

    .sign{
        font-size: 13px;
    }

    .form-label{
        font-weight: bold;
    }

    /* .form-control{
        margin-bottom: 0.5rem;
    } */
    
    .form-control, .form-select{
        background-color: rgb(239, 237, 242) !important;

    }

</style>