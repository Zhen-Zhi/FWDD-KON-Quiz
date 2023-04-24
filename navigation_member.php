<?php include("template.html"); ?>
<nav class="navbar fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            KON-QUIZ
        </a>
        <form class="d-flex m-0" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <div class="btn-group">
            <a href="#" role="button" class="btn hamburger" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-start">
                <li><a class="dropdown-item" href="#">Dashboard</a></li>
                <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                <li><a class="dropdown-item" href="#">Log Out</a></li>
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
</style>