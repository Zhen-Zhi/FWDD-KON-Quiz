<?php 
    include("../template/template.html"); 
    include("../template/toast.php");
    include("../conn.php");
    session_start();
?>

<div class="container px-1 py-5">
    <div class="shadow px-1 py-5 mt-3 mb-5">
    <h2 class="fw-bold pb-4 text-center">Admin Login</h2>
            <div class="modal-body">
                <form class="needs-validation" action="" method="POST" novalidate id="login-form">
                    <div class="col-md-6 mx-auto">
                        <label for="" class="form-label">Username</label>
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
                        <input type="hidden" name="loginadmin" value="1">
                        <button class="btn btn-secondary w-50" type="submit" name="login">
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
                        $('#liveToast').addClass('text-bg-danger');
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