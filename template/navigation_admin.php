<?php 
    include("template.html"); 
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            KON-QUIZ
            <span class="fs-6">admin</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Edit
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/FWDD-KON-QUIZ/admin/adminhome.php">Quiz</a></li>
                        <li><a class="dropdown-item" href="/FWDD-KON-QUIZ/admin/adminuser.php">Users</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" href="/FWDD-KON-QUIZ/admin/admin_view_report">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" type="button" href="/FWDD-KON-QUIZ/admin/logoutadmin.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    body{
        /* padding-top: 8vh; */
        /* background-color: #E6E8EC; */
    }
</style>