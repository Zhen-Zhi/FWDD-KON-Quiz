<head>
    <title>KON Quiz - Homepage</title>
</head>

<?php 
    include("session.php");
    // if(isset($_SESSION['id'])){
    //     echo "<script>alert(1);</script>";
    // }else{
    //     // include("navigation_guest.php");
    //     echo "<script>alert(123);</script>";
    // }
?>
<div class="container-fluid pt-5 px-5">
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card h-100 border-0 shadow">
                <div class="card-body" style="display: <?php if (isset($_SESSION['id'])) echo 'none' ?>">
                    <div class="row">
                        <div class="col-md-12 justify-content-center d-flex flex-row">
                            <button class="btn home-btn">Login</button>
                            <div class="vl h-auto mx-2"></div>
                            <button class="btn home-btn">Sign-up</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12 text-center">
                            Login to View Profile
                        </div>
                    </div>
                </div>

                <div class="card-body" style="display: <?php if (isset($_SESSION['id'])) echo 'block' ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="img/nerd.png" class="img-thumbnail thumbnail" alt="...">
                        </div>
                        <div class="col-md-6">
                            <h4><?php if (isset($_SESSION['id'])) echo $_SESSION['username'] ?></h4>
                            <button class="btn home-btn">Edit Profile</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card h-100 border-0 shadow">
                <div class="card-body">
                    <h4 class="card-title">Enter Code to Join</h4>
                    <div class="card-text">
                        <form action="">
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn home-btn" type="submit" name="login">
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
        <div class="carousel-inner h-50">
            <div class="carousel-item active">
                <img src="img/qr.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/wiz.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
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
            <div class="col">
                <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include("footer.php"); 
?>

<script>
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

    .home-btn{
        background-color: #6E2BF2 !important;
        border-bottom: 5px solid #1c0052 !important;
        color: white !important;
    }

    .home-btn:hover{
        background-color: #7e42f5 !important;
        border-bottom: 5px solid #1c0052;
        color: white;
    }

    .thumbnail{
        border-radius: 100% !important;
    }
</style>