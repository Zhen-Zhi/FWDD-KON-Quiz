<?php 
    include("session.php");
    include("conn.php");
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];    
        $query = "SELECT * FROM user where ID = $id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        $image_data = base64_encode($row['Profile_pic']);
        $image_src = "data:image/jpeg;base64,{$image_data}";
    }
?>

<head>
    <title>KON Quiz - Homepage</title>
</head>

<div class="container-fluid px-5">
    <div class="row">
        <div class="col-md-5 mt-3">
            <div class="card h-100 border-0 shadow">
                <div class="card-body my-5" style="display: <?php if (isset($_SESSION['id'])) echo 'none' ?>">
                    <div class="row">
                        <div class="col-md-12 justify-content-center d-flex flex-row">
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#login">Login</button>
                            <div class="vl h-auto mx-2"></div>
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#signup">Sign-up</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 text-center">
                            Login to View Profile
                        </div>
                    </div>
                </div>

                <div class="card-body p-0" style="display: <?php if (isset($_SESSION['id'])) echo 'block'; else echo'none';?>">
                    <div class="row">
                        <div class="col-md-4 text-center py-2 profile">
                            <img src="<?php echo $image_src?>" onerror="this.src='img/nerd.png';" class="img-thumbnail thumbnail" alt="...">
                        </div>
                        <div class="col-md-6 my-auto text-center mx-auto py-3">
                            <h4><?php if (isset($_SESSION['id'])) echo $_SESSION['username']; ?></h4>
                            <button class="btn btn-dark" onclick="window.location.href='user/edit_profile.php'">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 mt-3">
            <div class="card h-100 border-0 shadow">
                <div class="card-body">
                    <h4 class="card-title">Enter Code to Join</h4>
                    <div class="card-text">
                        <form action="" method="GET" id="join-quiz">
                            <div class="d-flex">
                                <div class="col-md-9 me-3">
                                    <input type="text" class="form-control" name="room" id="room_id">
                                    <div class="invalid-feedback">
                                        <p>Room Not Found.</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-dark" type="submit" name="login">
                                        Enter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-5 mt-3">
    <div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel-3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/carousel-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/carousel-1.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container-fluid px-5 category mt-3">
    <h3>Category</h3>
    <div class="overflow-auto scrollbar-x card-container">
        <div class="row mb-1 row-cols-1 row-cols-md-3 g-4 flex-nowrap">

            <?php
                $sqlcategory = "SELECT * FROM category";
                $result = mysqli_query($con, $sqlcategory);
                $color = array('#04AF70','#fe2c54', '#F6BE00', '#008B8B');
                $x=0;
            while ($row = mysqli_fetch_assoc($result)) {
                $x++;
                $class = $color[$x%4];
            ?>
            <div class="col">
                <button onclick="showCategoryQuiz(<?php echo $row['ID'] ?>)" class="btn mt-3 mb-3 pt-5 pb-5 w-100 " type="button" style= "height: 25vh; font-weight: bold; font-size: 3vh; background-color: <?php echo $class ?> !important">
                    <?php echo $row['Category'] ?>
                </button>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php 
    include("template/footer.php"); 
?>

<script>
    function showCategoryQuiz(id) {
        const url = "all_quiz.php" +
            "?cat_id=" + id;

        window.location.href = url;
    }

    function redirectProfilePic() {
        window.location.href = "user/profile_pic.php";
    }

    $(document).ready(function() {
        $('#join-quiz').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'check_quiz.php',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    if (data.quiz == "Success") {
                        $('#room_id').removeClass('is-invalid');
                        window.location.href = '/FWDD-KON-QUIZ/quiz/quiz.php?room_id=' + data.room_id;
                    }
                    else {
                        $('#room_id').removeClass('is-valid').addClass('is-invalid');
                    }
                }
            })
        })
    });
</script>

<style>
    .scrollbar-x::-webkit-scrollbar {
        height: 12px;
        background-color: #f5f5f5;
    }

    .scrollbar-x::-webkit-scrollbar-thumb {
        background-color: #000;
        border-radius: 10px;
    }

    .scrollbar-x::-webkit-scrollbar-track {
        background-color: #f5f5f5;
    }

    .scrollbar-x::-webkit-scrollbar-thumb:hover {
        background-color: #555;
    }

    .scrollbar-x::-webkit-scrollbar-track:hover {
        background-color: #ddd;
    }

    .scrollbar-x::-webkit-scrollbar-thumb:active {
        background-color: #888;
    }

    .scrollbar-x::-webkit-scrollbar {
        width: 12px;
        height: 12px;
        background-color: #f5f5f5;
    }

    .scrollbar-x::-webkit-scrollbar-thumb {
        background-color: #ccc;
    }

    .scrollbar-x::-webkit-scrollbar-track {
        background-color: #f5f5f5;
    }

    .scrollbar-x::-webkit-scrollbar-thumb:hover {
        background-color: #aaa;
    }

    .scrollbar-x::-webkit-scrollbar-track:hover {
        background-color: #ddd;
    } 

    .overflow-auto{
        overflow-x: scroll;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }

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

    .vl {
        border-left: 1px solid gray;
        height: 1rem;
    }

    .thumbnail{
        border-radius: 100% !important;
        width: 150px;
        height: 150px;
    }

    .category .btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    }

    .profile{
        background-color:#6E2BF2;
    }
</style>