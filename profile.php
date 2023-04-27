<head>
    <title>KON Quiz - Profile</title>
</head>

<?php 
    include("session.php");
?>

<div class="container-fluid pt-5 mt-2 px-5">
    <div class="row mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="homepage.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </nav>
    </div>
</div>


<div class="container-fluid px-5">
    <div class="row">
        <div class="fixed mt-4">
            <div class="card border-0 shadow-lg" style="height: 80vh; background-color: #1c0052; !important">
                
                <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO havent add username and prof pic -->

                <a href="homepage.php" class="nav-link navi fs-4" role="button">HOME</a>
                <a href="homepage.php" class="nav-link navi fs-4" role="button">MY QUESTIONS</a>
                <a href="homepage.php" class="nav-link navi fs-4" role="button">REPORT</a>
                <a href="homepage.php" class="nav-link navi fs-4" role="button">LOG OUT</a>
            </div>
        </div>
        <div class="col mt-4">
            <div class="card border-0 shadow-lg" style="height: 80vh;">
                <div class="col px-3">

                <h2 class="card-title fs-1 pb-1 pt-4 mb-3 px-3" style="font-weight: bold; color: black !important">Your Current Quizzes</h2>

                    <!-- HELLOOOOOOOOOOOOOOOOOOOOOOOOO need put loop here from database -->
                    
                    <button class="btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "width: 40vh; height: 20vh; font-weight: bold; font-size: 3vh; color: white !important; background-color: #fe2c54 !important">
                        MATHS QUIZ
                    </button>

                    <button class="btn my-4 mx-2 px-5 py-5" type="submit" name= "" style= "width: 40vh; height: 20vh; font-weight: bold; font-size: 3vh; color: white !important;">
                        + ADD QUIZ
                    </button>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>
</div>


<?php 
    include("footer.php"); 
?>


<style>
    .fixed{
        width: 300px;
    }

    .navi{
        color: white !important;
        padding-top: 1.5vh;
        padding-bottom: 1.5vh;
        display: flex;
        justify-content: center;
    }
</style>
