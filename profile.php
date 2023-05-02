<head>
    <title>KON Quiz - Profile Page</title>
</head>

<?php 
    include("session.php");
?>
<div class="container-fluid pt-5 mt-2 px-5">
    <div class="row mt-4">
        <button type="button" data-bs-toggle="modal" data-bs-target="#sidebar">Sidebar</button>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Page</li>
        </nav>
    </div>
</div>

<div class="container-fluid px-5">
    <div class="row">
        <div class="col mt-4">
            <div class="card border-0 shadow-lg" style="height: 80vh;">
                <div class="col px-3">

                <h2 class="card-title fs-1 pb-1 pt-4 mb-3 px-3" style="font-weight: bold; color: black !important">Your Current Quizzes</h2>

                    <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
                    
                    <button class="btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "width: 40vh; height: 20vh; font-weight: bold; font-size: 3vh; color: white !important; background-color: #fe2c54 !important">
                        MATHS QUIZ
                    </button>

                    <button class="btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "width: 40vh; height: 20vh; font-weight: bold; font-size: 3vh; color: red !important;">
                        + ADD QUIZ
                    </button>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="sidebar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header shadow">
                <table>
                    <tr>
                        <td><img src="img/nerd.png" class="img-thumbnail thumbnail mx-5" alt="..."><td>
                    </tr>
                    <tr>
                        <td><h4 class="username p-3"><?php if (isset($_SESSION['id'])) echo $_SESSION['username']; ?></h4></td>
                    </tr>
                </table>
            </div> 
            <div class="modal-body">
                <div class="sidebar">
                    <a href="#">Home</a>
                    <a href="#">Home1</a>
                    <a href="#">Home2</a>
                    <a href="#">Home3</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include("footer.php"); 
?>

<style>
    .username {
        text-align: center;
    }

    .fixed{
        width: 100px;
    }

    .navi{
        color: white !important;
        padding-top: 1.5vh;
        padding-bottom: 1.5vh;
        display: flex;
        justify-content: center;
    }

    .sidebar {
        height: 100%;
        width: 100%;
    }

    .sidebar a {
        display: block;
        width: 100%;
        padding: 20px;
        text-align: center;
    }

    .thumbnail{
        border-radius: 100% !important;
        width: 150px;
        height: 150px;
    }

    #modal-btn{
        background-color: #6E2BF2 !important;
        color: white !important;
        border-radius: 5px;
    }

    .modal-dialog {
        position: fixed;
        margin: auto;
        height: 100%;
    }

    .modal-content {
        height: 100%;
        border-radius: 0px;
    }

    .modal-header {
        border-radius: 0px;
    }
</style>
