<?php 
    include("template.html");
    include("navigation.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz - Homepage</title>
        <meta name="description" content="Home Page. Enter a code to join quiz.">
        <meta name="keywords" content="html tutorial template">
    </head>
    
    <body>
        <!-- <nav class="navbar fixed-top bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> 
                    TITLE
                </a>

                <form class="form-inline">
                    <button class="btn btn-light" type="button">LOG IN</button>
                    <button class="btn btn-secondary" type="button">SIGN UP</button>
                </form>
            </div>
            
        </nav> -->
        <div class="container shadow">
            <div class="row">
                <div class="col-md-6 text-center bg-light px-0 rounded">
                    <div class="image">
                        <img src="img/qr.png" alt="">
                    </div>
                    
                </div>
                <div class="col-md-6 px-0 bg-white">
                    <div class="content">
                        <div class="title">
                            Join a Quiz
                        </div>
                        <form class="col-sm-7 mx-auto">
                            <label for="" class="form-label">Enter Code:</label>
                            <input class="form-control" type="text">

                            <div class="col-md-7 mb-2 mx-auto text-center">
                                <button class="btn btn-primary mt-2 text-center" name="login">
                                    ENTER
                                </button>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    /* body{
        background-color: rgb(230, 230, 230);
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    } */
    
    .title{
        padding-top: 1em;
        padding-bottom: 1em;
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }

    .image{
        height: 50vh !important;
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .content{
        height: 50vh !important;
    }

    .form-control{
        background-color: rgb(239, 237, 242) !important;

    }
</style>