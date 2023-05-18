<?php 
    include("../template/template.html"); 
    include("../template/toast.php");
    include("../conn.php");
    session_start();
?>

<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="container py-5">
        <div class="col-md-4 mx-auto">
            <h2 class="fw-bold pb-4 text-decoration-underline">Admin Login</h2>
        </div>
        
        <form class="needs-validation" action="" method="POST" novalidate id="login-form">
            <div class="form-floating col-md-4 mx-auto mb-3">
                <input type="text" class="form-control" id="credential" name="credential" placeholder="name@example.com">
                <label for="credential"><i class="bi bi-person-circle me-1"></i>Username</label>
                <div class="invalid-feedback">
                </div>
            </div>
            <div class="form-floating col-md-4 mx-auto mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password"><i class="bi bi-shield-lock-fill me-1"></i>Password</label>
                <div class="invalid-feedback">
                </div>
            </div>
            
            <div class="col-md-4 mx-auto text-center">
                <input type="hidden" name="loginadmin" value="1">
                <button class="btn btn-secondary w-100" type="submit" name="login">
                    <div id="login-text">
                        LOGIN
                    </div>
                    <div class="spinner-border spinner-border-sm text-light" id="spinner" role="status" hidden disabled>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
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
                            window.location.href = '/FWDD-KON-QUIZ/admin/adminhome.php';
                        }, 2000);
                    } else {
                        $('#liveToast').addClass('text-bg-danger mt-2');
                        $('#liveToast').find('.toast-body').html(data.message);
                        toastBootstrap.show();
                        $('#credential').removeClass('is-valid').addClass('is-invalid');
                        $('#password').removeClass('is-valid').addClass('is-invalid');
                    }
                }
            });
        });

        $('#login-btn').on('click', function() {
            $(this).addClass('active');
        });
    });


</script>