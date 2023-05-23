<?php 
    include("template.html"); 
    include("toast.php");
?>
<nav class="navbar fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/FWDD-KON-QUIZ/">
            KON-QUIZ
            <span class="fs-6">admin</span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item nav-bar">
                <a class="nav-link text-light" type="button" href="/FWDD-KON-QUIZ/admin/adminhome.php">MODIFY QUIZ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" type="button" href="/FWDD-KON-QUIZ/admin/adminuser.php">MODIFY USERS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" type="button" href="/FWDD-KON-QUIZ/admin/admin_view_report">VIEW REPORTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" type="button" href="/FWDD-KON-QUIZ/admin/logoutadmin.php">LOGOUT</a>
            </li>
        </ul>
    </div>
    
</nav>

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