<?php 
    include("template.html"); 
    include("sidebar.php");
?>

<nav class="navbar fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex m-0" role="search" action="/FWDD-KON-QUIZ/quiz/quiz.php" method="GET">
            <input class="me-2" type="text" placeholder="Enter a room ID..." aria-label="Search" id="search-bar" name="room_id">
            <button class="btn btn-outline-light" type="submit" id="search-btn">Join</button>
        </form>
        <a class="navbar-brand" href="/FWDD-KON-QUIZ/homepage.php">
            KON-QUIZ
        </a>
    </div>
</nav>

<style>
    body{
        padding-top: 8vh;
    }

    .navbar{
        background-color: #1c0052 !important;
    }

    #search-bar {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    #search-bar:focus {
        color: #212529;
        background-color: #fff;
        border-color: #8C44FC;
        outline: 0;
        box-shadow: 0 0 0 .2rem rgba(140, 68, 252, .25);
    }

    @media screen and (max-width: 570px) {
        #search-bar {display: none}
        #search-btn {display: none}   
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

    #modal-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
        border-radius: 5px;
    }

    #modal-btn:hover{
        background-color: #7e42f5 !important;
        border-bottom: 5px solid #1c0052;
        color: white;
    }

    #modal-btn-close:focus{
        box-shadow: none;  
    }

    .form-label{
        font-weight: bold;
    }
</style>