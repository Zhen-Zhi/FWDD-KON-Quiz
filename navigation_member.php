<?php include("template.html"); ?>
<nav class="navbar fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./homepage.php">
            KON-QUIZ
        </a>
        <form class="d-flex m-0" role="search">
            <input class="me-2" type="search" placeholder="Search" aria-label="Search" id="search-bar">
            <button class="btn btn-outline-light" type="submit" id="search-btn">Search</button>
        </form>
        <div class="btn-group">
            <a href="#" role="button" class="btn hamburger" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-start">
                <li><a class="dropdown-item" href="profile.php">Dashboard</a></li>
                <li><a class="dropdown-item" href="edit_profile2.php">Edit Profile</a></li>
                <li>
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar{
        background-color: #1c0052 !important;
    }

    .hamburger{
        border-radius: 10% !important;
    }

    .hamburger:focus{
        border-radius: 10% !important;
        outline: none;
        background-color: #6E2BF2 !important;
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